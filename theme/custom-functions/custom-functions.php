<?php

function print_home_header_section()
{ ?>
    <section class="bg-neutral-800">
        <div class="container mx-auto h-52 py-5">
            <h2 class="font-bold text-4xl text-center text-neutral-50">Búsqueda</h2>
            <input class="w-full rounded p-5 text-xl" type="text" placeholder="Madrid, Valencia">
        </div>
    </section>
<?php
}

function in_get_innmuebles()
{
}



function print_home_featured_section()
{ ?>
    <section class="bg-neutral-800">
        <div class="container mx-auto p-5">
            <h2 class="font-bold text-4xl mb-5 text-center text-neutral-50">Destacados</h2>

            <div class="grid grid-cols-3 gap-5 ">
                <?php
                $inmuebles = in_inmueble_get_featured();
                foreach ($inmuebles as $inmueble) : ?>
                    <?php
                    $titulo = $inmueble->inmueble_get_titulo();
                    $estado = $inmueble->inmueble_get_estado();
                    $precio = $inmueble->inmueble_get_precio();
                    $categoria_estado = $inmueble->inmueble_get_categoria_estado() ? $inmueble->inmueble_get_categoria_estado()[0] : "";
                    ?>
                    <article class="bg-neutral-700/40 text-neutral-50 shadow rounded-lg overflow-hidden">

                        <header>
                            <div class="relative">
                                <img class="w-full object-cover" src="https://placehold.co/400x300/000/fff" alt="">
                                <?php if (!empty($categoria_estado)) : ?>
                                    <div class="absolute top-0 right-0 z-10 bg-black/60 w-full h-full"></div>
                                    <div class='top-[50%] left-[50%] -translate-x-1/2 absolute z-20 bg-red-600 text-neutral-50 rounded-sm p-1 uppercase font-semibold text-2xl'><?php echo $categoria_estado->name ?></div>
                                <?php endif; ?>

                                <div class="absolute top-0 left-0 p-2 w-full flex items-start justify-between">
                                    <div class="inline-block uppercase text-xs bg-neutral-700 rounded-sm p-1">
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

                        <div class="px-5 my-4">
                            <p> <?php echo $inmueble->inmueble_get_categoria_tipo()[0]->name ?> </p>
                            <p><?php echo $inmueble->inmueble_get_direccion(); ?></p>
                        </div>

                        <footer class="px-5">
                            <a class="in-border-button">Información</a>
                        </footer>
                    </article>

                <?php endforeach; ?>
            </div>

            <div class="mt-10 flex items-center justify-center">
                <a class="bg-primary text-neutral-50 hover:bg-secondary transition-colors font-semibold text-lg px-2 py-1 rounded inline-block cursor-pointer no-underline" href="<?php echo get_site_url(); ?>/inmuebles">Ver más</a>
            </div>

        </div>
    </section>
<?php
}
