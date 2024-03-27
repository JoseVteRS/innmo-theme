<?php

class InmuebleModel
{
    private $id;
    private $titulo;
    private $precio;
    private $direccion;
    private $estado;
    private $categoria_tipo;
    private $categoria_estado;
    private $categoria_destacado;

    function __construct(
        $id,
        $titulo,
        $precio,
        $direccion,
        $estado,
        $categoria_tipo,
        $categoria_estado,
        $categoria_destacado,
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->direccion = $direccion;
        $this->estado = $estado;
        $this->categoria_tipo = $categoria_tipo;
        $this->categoria_estado = $categoria_estado;
        $this->categoria_destacado = $categoria_destacado;
    }

    public function inmueble_get_id()
    {
        return $this->id;
    }

    public function inmueble_get_titulo()
    {
        return $this->titulo;
    }

    public function inmueble_get_precio()
    {
        return $this->precio;
    }

    public function inmueble_get_direccion()
    {
        return $this->direccion;
    }

    public function inmueble_get_estado()
    {
        return $this->estado;
    }

    /**
     * @return WP_Term
     */
    public function inmueble_get_categoria_tipo()
    {
        return $this->categoria_tipo;
    }

    public function inmueble_get_categoria_estado()
    {
        return $this->categoria_estado;
    }

    public function inmueble_get_categoria_destacado()
    {
        return $this->categoria_destacado;
    }
}

/**
 * 
 * @return InmuebleModel[]
 */
function in_inmueble_get_all()
{
    $args = array(
        'post_type' => 'inmueble',
        'posts_per_page' => 99, // Limitar a 99 inmuebles para mejorar la eficiencia
        'no_found_rows' => true, // Esto ayuda a mejorar el rendimiento al no contar las filas
        'update_post_meta_cache' => false, // Desactivar la caché de meta para mejorar la eficiencia
        'update_post_term_cache' => false, // Desactivar la caché de términos para mejorar la eficiencia
    );

    $query = new WP_Query($args);
    $inmuebles = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            // Agregar cada inmueble al array de inmuebles
            $inmuebles[] = new InmuebleModel(
                get_the_ID(),
                get_the_title(),
                pods('inmueble', $id)->field('inmueble-precio'),
                pods('inmueble', $id)->field('inmueble-direccion'),
                pods('inmueble', $id)->field('inmueble-estado'),
                wp_get_post_terms($id, 'tipo'),
                wp_get_post_terms($id, 'estado'),
                wp_get_post_terms($id, 'destacado'),
            );
        }
        wp_reset_postdata(); // Restablecer el postdata global para evitar conflictos
    } else {
        return [];
    }

    return $inmuebles;
}


/**
 * 
 * @return InmuebleModel[]
 */
function in_inmueble_get_all_by_params($params)
{

    $args = array(
        'post_type' => 'inmueble',
        'posts_per_page' => 99, // Limitar a 99 inmuebles para mejorar la eficiencia
        'no_found_rows' => true, // Esto ayuda a mejorar el rendimiento al no contar las filas
        'update_post_meta_cache' => false, // Desactivar la caché de meta para mejorar la eficiencia
        'update_post_term_cache' => false, // Desactivar la caché de términos para mejorar la eficiencia
    );

    if (isset($params['tipo']) && !empty($params['tipo'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'tipo',
                'field'    => 'slug',
                'terms'    => $params['tipo'],
            ),
        );
    }

    $query = new WP_Query($args);
    $inmuebles = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            // Agregar cada inmueble al array de inmuebles
            $inmuebles[] = new InmuebleModel(
                get_the_ID(),
                get_the_title(),
                pods('inmueble', $id)->field('inmueble-precio'),
                pods('inmueble', $id)->field('inmueble-direccion'),
                pods('inmueble', $id)->field('inmueble-estado'),
                wp_get_post_terms($id, 'tipo'),
                wp_get_post_terms($id, 'estado'),
                wp_get_post_terms($id, 'destacado'),
            );
        }
        wp_reset_postdata(); // Restablecer el postdata global para evitar conflictos
    } else {
        return [];
    }

    return $inmuebles;
}


function in_inmueble_get_featured()
{
    $args = array(
        'post_type' => 'inmueble',
        'posts_per_page' => 10, // Limitar a 99 inmuebles para mejorar la eficiencia
        'no_found_rows' => true, // Esto ayuda a mejorar el rendimiento al no contar las filas
        'update_post_meta_cache' => false, // Desactivar la caché de meta para mejorar la eficiencia
        'update_post_term_cache' => false, // Desactivar la caché de términos para mejorar la eficiencia
        'tax_query' => array(
            array(
                'taxonomy' => 'destacado',
                'field'    => 'slug',
                'terms'    => 'destacado',
            ),
        ),
    );

    $query = new WP_Query($args);
    $inmuebles = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            // Agregar cada inmueble al array de inmuebles
            $inmuebles[] = new InmuebleModel(
                get_the_ID(),
                get_the_title(),
                pods('inmueble', $id)->field('inmueble-precio'),
                pods('inmueble', $id)->field('inmueble-direccion'),
                pods('inmueble', $id)->field('inmueble-estado'),
                wp_get_post_terms($id, 'tipo'),
                wp_get_post_terms($id, 'estado'),
                wp_get_post_terms($id, 'destacado'),
            );
        }
        wp_reset_postdata(); // Restablecer el postdata global para evitar conflictos
    } else {
        return [];
    }

    return $inmuebles;
}
