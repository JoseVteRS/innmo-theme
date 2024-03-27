<?php
class TipoTaxonomia
{
    /**
     * @return WP_Term[]
     */
    public static function in_get_tipo()
    {
        $tipos = get_terms([
            'taxonomy' => 'tipo',
            'hide_empty' => false,
        ]);

        return $tipos;
    }
}


function tipos_get_all()
{
    return TipoTaxonomia::in_get_tipo();
}
