<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CheckBidController;
use App\Http\Controllers\PlaceBidController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentBidController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\FormPartnerController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\UserActivationController;
use App\Http\Controllers\PartnerExpertiseController;
use App\Http\Controllers\ApplicationPartnerController;
use App\Http\Controllers\ApplicationCustomerController;

Route::get("/", DashboardController::class)->name("dashboard")->middleware(["auth"]);

Route::get("login", [AuthController::class, "login"])->name("login");
Route::get("logout", [AuthController::class, "logout"])->name("logout");
Route::get("register", [AuthController::class, "register"])->name("register");
Route::post("login", [AuthController::class, "loginProcess"])->name("login.process");
Route::post("register", [AuthController::class, "registerProcess"])->name("register.process");

Route::get("change_password", [AuthController::class, "changePassword"])->name("change_password")->middleware(["auth"]);
Route::post("change_password", [AuthController::class, "changePasswordProcess"])->name("change_password.process")->middleware(["auth"]);

Route::resource("menu", MenuController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("role", RoleController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("permission", PermissionController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("user", UserController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("documentation", DocumentationController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("service", ServiceController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("partner", PartnerController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("partner_expertise", PartnerExpertiseController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("order", OrderController::class)->middleware(["auth", "ensure.permission"]);
Route::resource("sale", SaleController::class)->middleware(["auth", "ensure.permission"]);

Route::get("setting", [SettingController::class, "index"])->name("setting.index")->middleware(["auth", "ensure.permission"]);
Route::post("setting", [SettingController::class, "process"])->name("setting.process")->middleware(["auth", "ensure.permission"]);
Route::get("user/activation/{user_id}", UserActivationController::class)->name("user.activation")->middleware(["auth", "ensure.permission"]);
Route::get("activity_log", [ActivityLogController::class, "index"])->name("activity_log")->middleware(["auth", "ensure.permission"]);

Route::get("form-partner", [FormPartnerController::class, "index"])->name("form-partner");
Route::post("form-partner", [FormPartnerController::class, "process"])->name("form-partner.process");
Route::get("place-bid/{order_id}/{partner_id}", [PlaceBidController::class, "index"])->name("place-bid");
Route::post("place-bid", [PlaceBidController::class, "process"])->name("place-bid.process");
Route::get("check-bid/{order_id}/{partner_id}", [CheckBidController::class, "index"])->name("check-bid");
Route::post("check-bid", [CheckBidController::class, "process"])->name("check-bid.process");
Route::get("payment-bid/{bid_id}", [PaymentBidController::class, "index"])->name("payment-bid");
Route::post("payment-bid", [PaymentBidController::class, "process"])->name("payment-bid.process");

Route::get("application-customer", [ApplicationCustomerController::class, "index"])->name("application-customer.index")->middleware(["auth"]);
Route::get("application-customer/pesan/{service_id}", [ApplicationCustomerController::class, "pesan"])->name("application-customer.pesan")->middleware(["auth"]);
Route::post("application-customer/pesan", [ApplicationCustomerController::class, "prosesPesanan"])->name("application-customer.prosesPesanan")->middleware(["auth"]);
Route::get("application-customer/pesanan/{user_id}", [ApplicationCustomerController::class, "pesanan"])->name("application-customer.pesanan")->middleware(["auth"]);
Route::get("application-customer/pesananByOrderId/{order_id}", [ApplicationCustomerController::class, "pesananByOrderId"])->name("application-customer.pesananByOrderId")->middleware(["auth"]);
Route::get("application-customer/cekTawaran/{bid_id}", [ApplicationCustomerController::class, "cekTawaran"])->name("application-customer.cekTawaran")->middleware(["auth"]);
Route::post("application-customer/pesanTawaran", [ApplicationCustomerController::class, "pesanTawaran"])->name("application-customer.pesanTawaran")->middleware(["auth"]);

Route::get("application-partner", [ApplicationPartnerController::class, "index"])->name("application-partner.index")->middleware(["auth"]);
Route::get("application-partner/avalaible", [ApplicationPartnerController::class, "avalaible"])->name("application-partner.avalaible")->middleware(["auth"]);
Route::get("application-partner/rest", [ApplicationPartnerController::class, "rest"])->name("application-partner.rest")->middleware(["auth"]);
Route::get("application-partner/pesanan", [ApplicationPartnerController::class, "pesanan"])->name("application-partner.pesanan")->middleware(["auth"]);
Route::get("application-partner/pesananByBidId/{bid_id}", [ApplicationPartnerController::class, "pesananByBidId"])->name("application-partner.pesananByBidId")->middleware(["auth"]);
Route::post("application-partner/tawar", [ApplicationPartnerController::class, "tawar"])->name("application-partner.tawar")->middleware(["auth"]);
Route::get("application-partner/selesai/{order_id}", [ApplicationPartnerController::class, "selesai"])->name("application-partner.selesai")->middleware(["auth"]);
Route::get("application-partner/tambahLayanan", [ApplicationPartnerController::class, "tambahLayanan"])->name("application-partner.tambahLayanan")->middleware(["auth"]);
Route::post("application-partner/tambahLayananProses", [ApplicationPartnerController::class, "tambahLayananProses"])->name("application-partner.tambahLayananProses")->middleware(["auth"]);
