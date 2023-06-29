<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Permission;
use App\Models\Documentation;
use Illuminate\Database\Seeder;
use App\Models\PartnerExpertise;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        /**
         * Variable to be seeded on menus table
         */
        $menu = Menu::setSeeder();

        /**
         * Variable to be seeded on settings table
         */
        $setting = [
            ["name" => "app_name", "value" => "Beres.in"],
            ["name" => "app_logo", "value" => "1687764132.png"],
            ["name" => "app_icon", "value" => "1687764144.png"],
            ["name" => "app_color", "value" => "danger"],
            ["name" => "app_font_color", "value" => "dark"],
        ];

        /**
         * Variable to be seeded on roles table
         */
        $role = [
            ["name" => ucfirst("admin")],
            ["name" => ucfirst("partner")],
            ["name" => ucfirst("client")],
        ];

        /**
         * Variable to be seeded on permissions table.
         * Every time a new menu is registered in the seeder,
         * the admin role automatically gets its access rights.
         */
        $permission = [];
        for($i = 1; $i <= count($menu); $i++){
            $permission[$i]["role_id"] = 1;
            $permission[$i]["menu_id"] = $i;
        }

        /**
         * Variable to be seeded on users table
         */
        $user = [
            [
                "name" => ucfirst("Andik Kurniawan"),
                "username" => "andik",
                "password" => bcrypt("qc_12345"),
                "phone_number" => "6281234567894",
                "role_id" => 1,
                "is_activated" => 1,
            ],
            [
                "name" => ucfirst("abdi"),
                "username" => "abdi",
                "password" => bcrypt("abdi"),
                "phone_number" => "6285733465398",
                "role_id" => 2,
                "is_activated" => 1,
            ],
            [
                "name" => ucfirst("budi"),
                "username" => "budi",
                "password" => bcrypt("budi"),
                "phone_number" => "6285733465396",
                "role_id" => 2,
                "is_activated" => 1,
            ],
            [
                "name" => ucfirst("candra"),
                "username" => "candra",
                "password" => bcrypt("candra"),
                "phone_number" => "6285733465395",
                "role_id" => 2,
                "is_activated" => 1,
            ],
            [
                "name" => ucfirst("Saudara Jaya"),
                "username" => "dedy",
                "password" => bcrypt("dedy"),
                "phone_number" => "6285733465399",
                "role_id" => 2,
                "is_activated" => 1,
            ],
        ];

        /**
         * Variable to be seeded on documentations table
         */
        $documentation = [
            ["menu_id" => 1, "description" => "Setting is a feature that serves to configure general information related to an application, including the application name, application icon, application logo, background color, and text color. You can define other information in the settings of the model."],
            ["menu_id" => 3, "description" => "Activity log is a feature designed to monitor the usage of an application. This feature keeps track of activities related to the application, including the addition, modification, and deletion of records."],
            ["menu_id" => 4, "description" => "Menu is a feature used to organize the routes or menus that will be displayed and registered within an application. It depicts the routes of your application, and each route should ideally be included in the menu table so that its permissions can be controlled."],
            ["menu_id" => 5, "description" => "Role are a feature used to define and manage access rights within an application. Generally, an application introduces the concept of admin and user access rights. However, you can develop these access rights according to the needs of your application."],
            ["menu_id" => 6, "description" => "Permission are a feature used to configure how a role can access a menu or multiple menus. Generally, this application grants more permissions to admins compared to users, but you can customize this concept according to your preferences."],
            ["menu_id" => 7, "description" => "User is a feature for managing users, including user addition, modification, and deletion. You can also activate users through this feature. Inactive users are not able to log in."],
            ["menu_id" => 8, "description" => "Documentation is used to assist users in understanding the functions of each feature within the application. You can modify existing documentation or even create documentation for the menus you have created yourself."],
        ];

        $service = [
            ["name" => "Service Mobil"],
            ["name" => "Cuci Mobil"],
            ["name" => "Salon Mobil"],
            ["name" => "Inspeksi Mobil"],
            ["name" => "Service Motor"],
            ["name" => "Cuci Motor"],
            ["name" => "Tambal Ban"],
            ["name" => "Carter Pickup"],
            ["name" => "Laundry"],
            ["name" => "Cleaning Service"],
            ["name" => "Asisten Rumah Tangga"],
            ["name" => "Service AC"],
            ["name" => "Tukang Kunci"],
            ["name" => "Tukang Bangunan"],
            ["name" => "Tukang Cat"],
            ["name" => "Tukang Listrik"],
            ["name" => "Tukang Ledeng"],
            ["name" => "Tukang Kebun"],
            ["name" => "Service Lampu"],
            ["name" => "Service TV"],
            ["name" => "Service Handphone"],
            ["name" => "Service Komputer"],
            ["name" => "Service Printer"],
            ["name" => "Service Kulkas"],
            ["name" => "Service Pompa Air"],
            ["name" => "Air Galon"],
            ["name" => "Perawat"],
            ["name" => "Caregiver"],
            ["name" => "Babby Sitter"],
            ["name" => "Sopir Mobil"],
            ["name" => "Instruktur Kebugaran"],
            ["name" => "Pijat Tunanetra"],
            ["name" => "Pijat Bayi"],
            ["name" => "Akupuntur"],
            ["name" => "Bekam"],
            ["name" => "Potong Rambut"],
            ["name" => "Salon Rambut"],
            ["name" => "Bimbel"],
            ["name" => "Penerjemah Bahasa Inggris"],
            ["name" => "Penerjemah Bahasa Mandarin"],
            ["name" => "Tour Guide"],
            ["name" => "Jasa Antri"],
        ];

        $expertise = [
            ["user_id" => 2, "service_id" => 1],
            ["user_id" => 3, "service_id" => 1],
            ["user_id" => 4, "service_id" => 1],
            ["user_id" => 5, "service_id" => 1],
        ];

        /**
         * Seeding process
         */
        Role::insert($role);
        Setting::insert($setting);
        Menu::insert($menu);
        Permission::insert($permission);
        User::insert($user);
        Documentation::insert($documentation);
        Service::insert($service);
        PartnerExpertise::insert($expertise);
    }
}
