<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'produto_id' => \App\Models\Produtos::factory(),
            'quantidade' => $this->faker->numberBetween(1, 50),
            'data_pedido' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Pendente', 'Concluído', 'Cancelado']),
            'fornecedor_id' => \App\Models\Fornecedores::factory(),
        ];
    }
}
