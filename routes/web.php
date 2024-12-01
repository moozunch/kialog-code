<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\AccountSettingsCommunity;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\MdiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Broadcast;

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::post('/account-settings/update', [AuthController::class, 'updateAccountSettings'])->name('account-settings.update');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-blocked-accounts', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-blocked-accounts');
Route::get('/pages/settings-community', [AccountSettingsCommunity::class, 'index'])->name('pages-settings-community');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/icons-mdi', [MdiIcons::class, 'index'])->name('icons-mdi');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

//LandingPage
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

//signup signin landing
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/signup', [AuthController::class, 'signup']);


Route::get('/signin', [AuthController::class, 'showSignInForm'])->name('signin');
Route::post('/signin', [AuthController::class, 'signin']);

Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::middleware(['auth'])->group(function () {

  // Main Page Route
  Route::get('/home', [Analytics::class, 'index']);

  // pages
  Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
  Route::post('/account-settings/update', [AuthController::class, 'updateAccountSettings'])->name('account-settings.update');
  Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
  Route::get('/pages/account-settings-blocked-accounts', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-blocked-accounts');



  //home
  Route::get('/home', [PostController::class, 'index'])->name('home');

  //Messages
  Route::get('/message', [MessageController::class, 'index'])->name('messages');

//Topic
Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
Route::get('/topic/{id}', [TopicController::class, 'show'])->name('topic.show');
Route::post('topics/{topic}/join', [TopicController::class, 'join'])->name('topics.join');
Route::resource('topics', TopicController::class);
Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');

  //Bookmarks
  Route::get('/bookmarks', [BookmarksController::class, 'index'])->name('bookmarks.index');
  Route::post('/bookmarks/{postId}', [BookmarksController::class, 'toggleBookmark'])->name('bookmarks.store');

  //Post - Like
  Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');

  //Posts - Home
  Route::resource('posts', PostController::class);
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/search-posts', [PostController::class, 'searchPosts'])->name('search.posts');
  Route::get('/all-posts', [PostController::class, 'getAllPosts'])->name('posts.all');

  //Setting - Profile
  Route::get('/settings', [AccountSettingsAccount::class, 'index'])->name('settings');

  //delete-post
  Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

  //delete-topic
  Route::resource('topics', TopicController::class);

  //profile
  // Route for the profile page (logged-in user's profile)
  Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');

  // Route for viewing another user's profile (optional, if you want to see other users' profiles)
  Route::get('/profile/{username}', [ProfileController::class, 'showProfile'])->name('profile.showOther');

  //delete-account
  Route::delete('/account/delete', [AuthController::class, 'deleteAccount'])->name('account.delete');

  // Message
  Route::get('/chat/{user_id}', [MessageController::class, 'chat'])->name('chat');
  Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
    return $user->conversations->contains($conversationId);
  });
  Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
  Route::get('/search-users', [MessageController::class, 'searchUsers'])->name('search.users');
  Route::get('/conversations', [MessageController::class, 'getAllConversations'])->name('conversations.all');

  //report
  Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
  Route::post('/posts/report', [ReportController::class, 'store'])->name('posts.report');

  //Block
  Route::post('/blocks', [BlockController::class, 'store'])->name('blocks.store');


  //Unblock
  Route::post('/blocks/unblock', [PostController::class, 'unblock'])->name('blocks.unblock');

  // Comment
  Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
  Route::post('/posts/{id}/comments', [PostController::class, 'storeComment'])->name('comments.store');
  Route::delete('/comments/{id}', [PostController::class, 'destroyComment'])->name('comments.destroy');

  // // Follower
  // Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile.show');
});
