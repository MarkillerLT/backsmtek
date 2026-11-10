<?php

namespace Tests\Feature;

use App\Models\Cotizacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CotizacionEliminarTest extends TestCase
{
    use RefreshDatabase;

    private function cotizacion(): Cotizacion
    {
        return Cotizacion::create([
            'nombre'    => 'Formulario basura',
            'correo'    => 'spam@example.com',
            'telefono'  => '0000000000',
            'asunto'    => 'asdf',
            'mensaje'   => 'asdf',
            'localidad' => 'Toluca',
            'estado'    => 'pendiente',
        ]);
    }

    public function test_admin_puede_eliminar_una_cotizacion(): void
    {
        $admin = User::factory()->create(['rol' => 'admin']);
        $cotizacion = $this->cotizacion();

        $this->actingAs($admin)
            ->delete(route('admin.cotizaciones.destroy', $cotizacion))
            ->assertRedirect(route('admin.cotizaciones.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('cotizaciones', ['id' => $cotizacion->id]);
    }

    public function test_usuario_normal_no_puede_eliminar(): void
    {
        $cotizacion = $this->cotizacion();

        $this->actingAs(User::factory()->create())
            ->delete(route('admin.cotizaciones.destroy', $cotizacion))
            ->assertRedirect('/');

        $this->assertDatabaseHas('cotizaciones', ['id' => $cotizacion->id]);
    }

    public function test_visitante_no_puede_eliminar(): void
    {
        $cotizacion = $this->cotizacion();

        $this->delete(route('admin.cotizaciones.destroy', $cotizacion))
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('cotizaciones', ['id' => $cotizacion->id]);
    }

    public function test_listado_y_detalle_muestran_el_boton_eliminar(): void
    {
        $admin = User::factory()->create(['rol' => 'admin']);
        $cotizacion = $this->cotizacion();
        $url = route('admin.cotizaciones.destroy', $cotizacion);

        $this->actingAs($admin)->get(route('admin.cotizaciones.index'))
            ->assertOk()
            ->assertSee('data-eliminar-url="'.$url.'"', false);

        $this->actingAs($admin)->get(route('admin.cotizaciones.show', $cotizacion))
            ->assertOk()
            ->assertSee('data-eliminar-url="'.$url.'"', false);
    }
}
