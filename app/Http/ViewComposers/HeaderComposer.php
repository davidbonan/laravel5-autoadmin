<?php
namespace App\Http\ViewComposers;

use Illuminate\ {
    View\View,
    Support\Facades\Route
};

class HeaderComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Breadcrumb
        $elements = config ('breadcrumbs');
        $segments = request()->segments();
        //dd($segments);
        foreach ($segments as $segment) {
            if (!is_numeric($segment)) {
                if (isset($elements[$segment])){
                    $elements[$segment]['name'] = $elements[$segment]['name'];
                    if ($segment === end($segments)) {
                        $elements[$segment]['url'] = '#';
                    }
                    $breadcrumbs[] = $elements[$segment];
                }
                elseif ($segment != 'auto'){
                    $breadcrumbs[] = array('name' => ucfirst($segment), 'url' => '');
                }                
            }
        }

        // Notification
        $countNotifications = auth()->user()->unreadNotifications()->count();

        $view->with(compact('breadcrumbs', 'countNotifications'));
    }
}