<?php

/*
 * Template Name: Inmuebles
 * Template Post Type: post, page
 */

if (!defined('ABSPATH')) {
    exit;
}
get_header()
?>

<?php
$inmuebles = in_inmueble_get_all();
?>

<main>

    <section class="container mx-auto p-5">
        <header>
            <h1 class="page-title text-center"><?php echo get_the_title() ?></h1>
        </header>

        <div class="mb-5">
            <select name="tipo" id="tipo-select" class="input">
                <option value="todos">Todos</option>
                <?php $tipos = tipos_get_all(); ?>
                <?php foreach ($tipos as $tipo) : ?>
                    <option value="<?php echo $tipo->slug; ?>" <?php if (get_query_var('tipo') == $tipo->slug) echo 'selected'; ?>><?php echo $tipo->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="inmueble-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            <?php foreach ($inmuebles as $inmueble) : ?>

                <?php
                $titulo = $inmueble->inmueble_get_titulo();
                $estado = $inmueble->inmueble_get_estado();
                $precio = $inmueble->inmueble_get_precio();
                $categoria_estado = $inmueble->inmueble_get_categoria_estado() ? $inmueble->inmueble_get_categoria_estado()[0] : "";
                ?>

                <article class="inmueble text-secondary shadow rounded-lg flex flex-col overflow-hidden" data-name="<?php echo $inmueble->inmueble_get_titulo() ?>" data-price="<?php echo $inmueble->inmueble_get_precio() ?>" data-type="<?php echo $inmueble->inmueble_get_categoria_tipo()[0]->slug ?>">
                    <header>
                        <div class="relative">
                            <img class="w-full object-cover" src="https://placehold.co/400x300/000/fff" alt="">
                            <?php if (!empty($categoria_estado)) : ?>
                                <div class="absolute top-0 right-0 z-10 bg-black/60 w-full h-full"></div>
                                <div class='top-[50%] left-[50%] -translate-x-1/2 absolute z-20 bg-red-600 text-neutral-50 rounded-sm p-1 uppercase font-semibold text-2xl'><?php echo $categoria_estado->name ?></div>
                            <?php endif; ?>

                            <div class="absolute top-0 left-0 p-2 w-full flex items-start justify-between">
                                <div class="inline-block uppercase text-xs bg-neutral-700 text-neutral-50 rounded-sm p-1">
                                    <?php echo $estado ?>
                                </div>
                                <div class="inline-block">⭐</div>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="font-semibold text-xl"><?php echo $titulo ?></h3>
                            <?php

                            if (is_numeric($precio)) {
                                if ("alquiler" == $estado) {
                                    echo "<span>{$precio} €/mes</span>";
                                } elseif ("venta" == $estado) {
                                    echo "<span>{$precio} €</span>";
                                }
                            } else {
                                echo "<span>{$precio}</span>";
                            }
                            ?>
                        </div>


                    </header>


                    <div class="px-5 my-4 flex-1">
                        <p> <?php echo $inmueble->inmueble_get_categoria_tipo()[0]->name ?> </p>
                        <p><?php echo $inmueble->inmueble_get_direccion(); ?></p>
                    </div>

                    <footer class="px-5 pb-5">
                        <a class="in-border-button">Información</a>
                    </footer>
                </article>

            <?php endforeach; ?>
        </div>

    </section>

</main>

<?php get_footer() ?>