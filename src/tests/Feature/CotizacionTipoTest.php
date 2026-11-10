<?php

namespace Tests\Feature;

use App\Exports\CotizacionesExport;
use App\Models\Cotizacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CotizacionTipoTest extends TestCase
{
    use RefreshDatabase;

    private function datos(array $extra = []): array
    {
        return array_merge([
            'nombre'    => 'Cliente Prueba',
            'empresa'   => 'ACME',
            'correo'    => 'cliente@example.com',
            'telefono'  => '4421234567',
            'asunto'    => 'Cotización de prueba',
            'mensaje'   => 'Detalle del proyecto',
            'localidad' => 'Queretaro',
        ], $extra);
    }

    public function test_visitante_guarda_tipo_y_sigue_redirigiendo_al_formulario(): void
    {
        $this->post(route('cotizacion.store'), $this->datos(['tipo_cotizacion' => 'maquinados']))
            ->assertRedirect(route('cotizacion.create'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('cotizaciones', [
            'tipo_cotizacion'     => 'maquinados',
            'otro_especificacion' => null,
            'estado'              => 'pendiente',
            'user_id'             => null,
        ]);
    }

    public function test_usuario_registrado_sigue_redirigiendo_a_mis_cotizaciones(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('cotizacion.store'), $this->datos(['tipo_cotizacion' => 'proyectos']))
            ->assertRedirect(route('cotizaciones.mias'));

        $this->assertDatabaseHas('cotizaciones', ['user_id' => $user->id, 'tipo_cotizacion' => 'proyectos']);
    }

    public function test_tipo_es_obligatorio_y_debe_ser_valido(): void
    {
        $this->post(route('cotizacion.store'), $this->datos())
            ->assertSessionHasErrors('tipo_cotizacion');

        $this->post(route('cotizacion.store'), $this->datos(['tipo_cotizacion' => 'inventado']))
            ->assertSessionHasErrors('tipo_cotizacion');

        $this->assertDatabaseCount('cotizaciones', 0);
    }

    public function test_otro_exige_especificacion(): void
    {
        $this->post(route('cotizacion.store'), $this->datos(['tipo_cotizacion' => 'otro', 'otro_especificacion' => '']))
            ->assertSessionHasErrors('otro_especificacion');

        $this->post(route('cotizacion.store'), $this->datos([
            'tipo_cotizacion'     => 'otro',
            'otro_especificacion' => '  Mantenimiento de maquinaria  ',
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('cotizaciones', [
            'tipo_cotizacion'     => 'otro',
            'otro_especificacion' => 'Mantenimiento de maquinaria',
        ]);
    }

    public function test_especificacion_se_descarta_si_el_tipo_no_es_otro(): void
    {
        $this->post(route('cotizacion.store'), $this->datos([
            'tipo_cotizacion'     => 'especializado',
            'otro_especificacion' => 'texto que no aplica',
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('cotizaciones', [
            'tipo_cotizacion'     => 'especializado',
            'otro_especificacion' => null,
        ]);
    }

    public function test_admin_ve_tipo_y_sin_clasificar_en_listado_detalle_y_exportaciones(): void
    {
        $admin = User::factory()->create(['rol' => 'admin']);

        $antigua = Cotizacion::create($this->datos(['estado' => 'pendiente']));
        $otro = Cotizacion::create($this->datos([
            'estado'              => 'pendiente',
            'tipo_cotizacion'     => 'otro',
            'otro_especificacion' => 'Automatización de banda',
        ]));

        $this->actingAs($admin)->get(route('admin.cotizaciones.index'))
            ->assertOk()
            ->assertSee('Sin clasificar')
            ->assertSee('Automatización de banda');

        $this->actingAs($admin)->get(route('admin.cotizaciones.show', $antigua))
            ->assertOk()
            ->assertSee('Sin clasificar');

        $this->actingAs($admin)->get(route('admin.cotizaciones.show', $otro))
            ->assertOk()
            ->assertSee('Especificación del cliente')
            ->assertSee('Automatización de banda');

        $filas = (new CotizacionesExport)->collection()->keyBy(0);
        $this->assertSame(['Sin clasificar', null], [$filas[$antigua->id][7], $filas[$antigua->id][8]]);
        $this->assertSame(['Otro', 'Automatización de banda'], [$filas[$otro->id][7], $filas[$otro->id][8]]);

        $this->actingAs($admin)->get(route('admin.cotizaciones.export.pdf'))->assertOk();
    }

    public function test_formularios_muestran_el_selector(): void
    {
        $this->get(route('cotizacion.create'))
            ->assertOk()
            ->assertSee('name="tipo_cotizacion"', false)
            ->assertSee('Otro (especifica)');

        $this->actingAs(User::factory()->create())
            ->get(route('cotizaciones.mias'))
            ->assertOk()
            ->assertSee('name="tipo_cotizacion"', false);
    }
}
