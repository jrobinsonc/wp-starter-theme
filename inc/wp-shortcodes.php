<?php

/**
 * Retorna la URL absoluta de lo que se le indique.
 * 
 * Ejemplo de uso:
 *  [get_url page=<page>] 
 *  Donde <page> es el ID de la página de la que se quiere obtener la URL.
 * 
 *  [get_url path=<path>]
 *  Done de path puede ser: uploads, theme, site.
 *  
 * @author JoseRobinson.com
 * @link https://gist.github.com/jrobinsonc/51f22866552407df7aa1
 */
add_shortcode('get_url', function($attrs) 
{
    if (isset($attrs['page']))
    {
        $url = get_page_link($attrs['page']);
    }
    elseif (isset($attrs['path']))
    {
        switch ($attrs['path']) 
        {
            case 'uploads':
                $upload_dir = wp_upload_dir();
                $url = $upload_dir['baseurl'];
                break;

            case 'theme':
                $url = get_template_directory_uri();
                break;

            case 'site':
                $url = get_bloginfo('url');
                break;
        }
    }
        
    if (isset($url))
        return $url;
});


add_shortcode('wp_function', function($args){

    $function_args = $args;
    unset($function_args['function']);

    foreach ($function_args as $key => $value) 
    {
        if ('false' === $value)
            $value = false;
        elseif ('true' === $value)
            $value = true;

        $function_args[$key] = $value;
    }

    return $args['function']($function_args);

});
