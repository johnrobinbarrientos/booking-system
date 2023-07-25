<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Main\TopMenu;
use App\Main\SuperAdminMenu;
use App\Main\SimpleMenu;
use App\Main\AdminMenu;
use App\Main\UserSideMenu;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!is_null(request()->route())) {
            $pageName = request()->route()->getName();
            $layout = $this->layout($view);
            $activeMenu = $this->activeMenu($pageName, $layout);


            $view->with('super_admin_menu', SuperAdminMenu::menu());
            $view->with('admin_menu', AdminMenu::menu());
            $view->with('user_menu', UserSideMenu::menu());
            $view->with('first_level_active_index', $activeMenu['first_level_active_index']);
            $view->with('second_level_active_index', $activeMenu['second_level_active_index']);
            $view->with('third_level_active_index', $activeMenu['third_level_active_index']);
            $view->with('page_name', $pageName);
            $view->with('layout', $layout);
        }
    }

    public function layout($view)
    {
        if (isset($view->layout)) {
            return $view->layout;
        } else if (request()->has('layout')) {
            return request()->query('layout');
        }

        return 'side-menu';
    }


    public function activeMenu($pageName, $layout)
    {
        $firstLevelActiveIndex = '';
        $secondLevelActiveIndex = '';
        $thirdLevelActiveIndex = '';

        return [
            'first_level_active_index' => $firstLevelActiveIndex,
            'second_level_active_index' => $secondLevelActiveIndex,
            'third_level_active_index' => $thirdLevelActiveIndex
        ];
    }
}
