<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\UpdateUserProfileController;
use App\Http\Controllers\EditUserProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\FeatureController;
use App\Services\MercadoPagoService;
use App\Services\PayPalService;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ShowAllUsersController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\FacebookController;
use App\Models\ChMessage; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LikeUserController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminNotificationController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\LegalContentController;
use App\Http\Controllers\QuoteController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {return view('home');})->name('home');
    Route::get('/profile', 'EditUserProfileController')->name('profile.edit');
    Route::get('/get-states', [EditUserProfileController::class, 'getStates']);
    Route::get('/get-cities', [EditUserProfileController::class, 'getCities']);
    Route::post('/profile', 'UpdateUserProfileController')->name('profile.update');
    Route::post('/upload-profile-picture', [UpdateUserProfileController::class, 'uploadPicture'])->name('upload.profile.picture');
    Route::post('/profile-instruction', [UpdateUserProfileController::class, 'updateInstruction'])->name('profile.updateInstruction');
    Route::get('/show-all', [ShowAllUsersController::class, '__invoke'])->name('users.show-all');
    Route::get('/get-match-result', [ShowAllUsersController::class, 'getMatchResult'])->name('getMatchResult');

    Route::get('/show-all/{user}/view', 'ShowUserInfoController')->name('users.show-user');
    
    Route::put('/show-all/{user}/view', 'LikeUserController')->name('users.like-user');

    Route::get('/likes', 'ViewLikesController')->name('view-likes');

    Route::get('/users/{user}/pictures', 'ShowUserPictures')->name('pictures');

    Route::get('/my-pictures', 'ShowAuthorizedUserPicture')->name('my-pictures');

    Route::post('/my-pictures', 'UploadUserPicture')->name('pictures.upload');

    Route::get('/messenger', [ChatController::class, 'messenger'])->name('messenger.chat');
    Route::get('/messenger/{id}', [ChatController::class, 'messenger'])->name('user.chat');
    Route::get('/get-unseen-messages', function () {return response()->json(['unseenCount' =>  ChMessage::where('to_id', Auth::id()) ->where('seen', false) ->count()]);});
    
    Route::get('/notifications', [NotificationController::class, 'fetchNotifications'])->name('notifications.fetch');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/deleteNotification', [NotificationController::class, 'deleteNotification'])->name('notifications.delete');

    Route::post('/like-action-url', [LikeUserController::class, 'likeUser']);
    Route::post('/dislike-action-url', [LikeUserController::class, 'dislikeUser']);
    Route::post('/accept-action-url', [LikeUserController::class, 'acecept']);
    Route::post('/profile-preview-complete', [LikeUserController::class, 'profilePreview']);
    Route::post('/mastering-response-url', [LikeUserController::class, 'mastering']);
    Route::post('/publish-comment', [LikeUserController::class, 'publishComment']);
    Route::post('/reject-action-url', [LikeUserController::class, 'reject']);
    Route::post('/mastering-activation-check', [LikeUserController::class, 'masteringActivationCheck']);
    Route::get('/getChatActivate', [LikeUserController::class, 'getChatActivation']);
    Route::get('/getProfileStatus', [UpdateUserProfileController::class, 'getProfileStatus']);
    
    Route::post('/have-date', [MeetingController::class, 'haveDate']);
    Route::post('/feedback-submit', [MeetingController::class, 'feedbackSubmit']);
    Route::post('/comment-submit', [MeetingController::class, 'commentSubmit']);
    Route::get('/ask-for-meeting', [MeetingController::class, 'askMeetingDate'])->name('meeting.askForMeeting');
    Route::post('/meeting-store', [MeetingController::class, 'storeMeetingDate'])->name('meeting.store_date');
    Route::get('/meeting-status', [MeetingController::class, 'askMeetingStatus'])->name('meeting.meetingstatus');
    Route::post('/meeting-status-store', [MeetingController::class, 'storeMeetingStatus'])->name('meetingstatus.store');
    Route::get('/likeToContinue', [MeetingController::class, 'likeToContinue'])->name('meeting.likeToContinue');
    Route::post('/likeToContinue-status', [MeetingController::class, 'storelikeToContinue'])->name('meeting.storelikeToContinue');

    Route::get('/followUp', [MeetingController::class, 'followUp'])->name('meeting.followUp');
    Route::post('/followUp/response', [MeetingController::class, 'followUpResponse'])->name('meeting.followUp.response');
    Route::get('/sendFeedback', [MeetingController::class, 'sendFeedback'])->name('meeting.sendFeedback');
    Route::get('/cancel-connection', [MeetingController::class, 'askCancelConnection'])->name('cancel.connection');
    Route::post('/cancel-connection-store', [MeetingController::class, 'storeCancelConnection'])->name('cancel.connection.store');
    Route::get('/know-more-time', [MeetingController::class, 'askMoreTime'])->name('meeting.moretime');
    Route::post('/know-more-time-store', [MeetingController::class, 'storeMoreTime'])->name('meeting.moretime.store');

    Route::get('/comment', [MeetingController::class, 'getComments'])->name('meeting.getComments');
    Route::post('/store/comment', [MeetingController::class, 'setComments'])->name('meeting.setComments');
    Route::get('/show/comment', [MeetingController::class, 'showComments'])->name('meeting.showComments');
    Route::get('/show/feedback', [MeetingController::class, 'showFeedbacks'])->name('meeting.showFeedbacks');
    
    // Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

    Route::get('/payment-now', [UpdateUserProfileController::class, 'paymentnow'])->name('payment.paymentnow');
    Route::get('/account-rejected', [UpdateUserProfileController::class, 'accountrejected'])->name('payment.accountrejected');
    Route::get('/approve-pending', [UpdateUserProfileController::class, 'approvalpending'])->name('payment.approvalpending');

    Route::post('/update-verification-status', [UpdateUserProfileController::class, 'updateVerificationStatus']);

    Route::get('/email_verify_now/{encodedUserId}', [UpdateUserProfileController::class, 'verifyEmail'])->name('email.verify');
    Route::post('/upload-cover-picture', [UpdateUserProfileController::class, 'uploadCoverPicture'])->name('upload.cover.picture');

    Route::post('/delete-image', [UpdateUserProfileController::class, 'delete'])->name('delete.image');
    Route::post('/set-profile-image', [UpdateUserProfileController::class, 'setProfileImage'])->name('user.setProfileImage');

    Route::get('user/subscription', [SubscriptionController::class, 'index'])->name('user.subscription.index');
    Route::post('user/subscription/purchase', [SubscriptionController::class, 'create'])->name('user.subscription.create');
    Route::post('user/subscription/pause', [SubscriptionController::class, 'pause'])->name('user.subscription.pause');
    Route::post('user/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('user.subscription.cancel');
    Route::post('user/subscription/extend', [SubscriptionController::class, 'extend'])->name('user.subscription.extend');

    Route::get('user/subscription/plans', [SubscriptionController::class, 'plans'])->name('user.subscription.plans');
    Route::get('user/create-payment/{id}', [PaymentController::class, 'createPaymentPreference'])->name('payment.checkout');
    Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
    Route::get('payment/pending', [PaymentController::class, 'paymentPending'])->name('payment.pending');

    Route::get('/menu', function () {return view('fullmenu');});
});

Route::post('/send-notification-chat', [ChatController::class, 'sendChatMail']);

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

Route::get('lang', [LanguageController::class, 'switchLang'])->name('lang.switch'); 


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('admin/login-functionality', [AdminController::class, 'login_functionality'])->name('login.functionality');
Route::middleware('auth:admin')->get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware('auth:admin')->get('/get-chart-data', [AdminController::class, 'getChartData'])->name('membership.chat');
Route::middleware('auth:admin')->get('/get-member-chart-data', [AdminController::class, 'getMemberChartData'])->name('members.chat');
Route::middleware('auth:admin')->get('admin/profile', [AdminProfileController::class, 'user_profile'])->name('admin.profile');
Route::middleware('auth:admin')->post('admin/profile-update', [AdminProfileController::class, 'update_user_profile'])->name('admin.profile.update');
Route::middleware('auth:admin')->get('admin/user-list', [AdminController::class, 'user_list'])->name('admin.user_list');
Route::middleware('auth:admin')->get('user-list', [AdminController::class, 'getuser'])->name('user.getuser');
Route::middleware('auth:admin')->get('admin/user-list/edit/{id}', [AdminController::class, 'edit_user'])->name('admin.user_list.edit');
Route::middleware('auth:admin')->post('admin/user-list/update', [AdminController::class, 'update_user'])->name('admin.user_list.update');
Route::middleware('auth:admin')->get('admin/user-list/view-user/{id}', [AdminController::class, 'viewUser'])->name('admin.user_list.viewUser');

Route::middleware('auth:admin')->get('admin/user/review-feedback/{id}', [AdminController::class, 'reviewFeedback'])->name('admin.user_list.reviewFeedback');

Route::middleware('auth:admin')->delete('admin/user-list/delete/{id}', [AdminController::class, 'delete_user'])->name('admin.user_list.delete_user');
Route::middleware('auth:admin')->get('admin/user-list/approve/{id}', [AdminController::class, 'userApprove'])->name('admin.user_list.approve');
Route::middleware('auth:admin')->get('admin/user-list/reject/{id}', [AdminController::class, 'userReject'])->name('admin.user_list.reject');

Route::middleware('auth:admin')->get('admin/user-list/block/{id}', [AdminController::class, 'userPermanentblock'])->name('admin.user_list.permanentblock');

Route::middleware('auth:admin')->get('admin/user-list/active-renewal/{id}', [AdminController::class, 'activateRenewal'])->name('admin.user_list.activateRenewal');

Route::middleware('auth:admin')->get('admin/subscription-plan', [AdminController::class, 'subscription'])->name('admin.subscriptions.index');
Route::middleware('auth:admin')->get('admin/subscription-plan-List', [AdminController::class, 'subscriptionList'])->name('admin.subscriptions.subscriptionList');
Route::middleware('auth:admin')->get('admin/subscription-plan/create', [AdminController::class, 'subscriptionCreate'])->name('admin.subscriptions.create');
Route::middleware('auth:admin')->post('admin/subscription-plan/store', [AdminController::class, 'subscriptionStore'])->name('admin.subscriptions.store');
Route::middleware('auth:admin')->get('admin/subscription-plan/edit/{id}', [AdminController::class, 'subscriptionEdit'])->name('admin.subscriptions.edit');
Route::middleware('auth:admin')->post('admin/subscription-plan/update', [AdminController::class, 'subscriptionUpdate'])->name('admin.subscriptions.update');
Route::middleware('auth:admin')->delete('admin/subscription-plan/destroy', [AdminController::class, 'subscriptionDestroy'])->name('admin.subscriptions.destroy');
Route::middleware('auth:admin')->patch('admin/subscription-plan/{subscription}', [AdminController::class, 'subscriptionUpdateStatus'])->name('admin.updateStatus');

Route::middleware('auth:admin')->get('admin/user-subscription', [AdminController::class, 'userSubscription'])->name('admin.usersubscriptions.index');
Route::middleware('auth:admin')->get('admin/user-subscription-List', [AdminController::class, 'userSubscriptionList'])->name('admin.subscriptions.usersubscriptionList');
Route::post('/admin/subscription/pause', [AdminController::class, 'pauseSubscription'])->name('admin.subscription.pause');
Route::post('/admin/subscription/extend', [AdminController::class, 'extendSubscription'])->name('admin.subscription.extend');
Route::post('/admin/subscription/cancel', [AdminController::class, 'cancelSubscription'])->name('admin.subscription.cancel');
Route::middleware('auth:admin')->post('/admin/upload/profile/picture', [AdminProfileController::class, 'uploadProfilePicture'])->name('admin.upload.profile.picture');
Route::post('/admin/subscription/reactive', [AdminController::class, 'reactiveSubscription'])->name('admin.subscription.reactiveSubscription');
// Feature Routes
Route::middleware('auth:admin')->get('admin/features', [FeatureController::class, 'index'])->name('admin.features.index'); 
Route::middleware('auth:admin')->get('admin/features/create', [FeatureController::class, 'create'])->name('admin.features.create'); 
Route::middleware('auth:admin')->post('admin/features', [FeatureController::class, 'store'])->name('admin.features.store'); 
Route::middleware('auth:admin')->get('admin/features/{feature}/edit', [FeatureController::class, 'edit'])->name('admin.features.edit'); 
Route::middleware('auth:admin')->put('admin/features/{feature}', [FeatureController::class, 'update'])->name('admin.features.update'); 
Route::middleware('auth:admin')->delete('admin/features/{feature}', [FeatureController::class, 'destroy'])->name('admin.features.destroy'); 
Route::middleware('auth:admin')->get('admin/features-list', [FeatureController::class, 'getFeatures'])->name('admin.features.getFeature');

Route::middleware('auth:admin')->get('admin/promocode', [PromocodeController::class, 'index'])->name('admin.promocode.index'); 
Route::middleware('auth:admin')->get('admin/promocode/create', [PromocodeController::class, 'create'])->name('admin.promocode.create'); 
Route::middleware('auth:admin')->post('admin/promocode', [PromocodeController::class, 'store'])->name('admin.promocode.store'); 
Route::middleware('auth:admin')->get('admin/promocode/{promocode}/edit', [PromocodeController::class, 'edit'])->name('admin.promocode.edit'); 
Route::middleware('auth:admin')->put('admin/promocode/{promocode}', [PromocodeController::class, 'update'])->name('admin.promocode.update'); 
Route::middleware('auth:admin')->delete('admin/promocode/{promocode}', [PromocodeController::class, 'destroy'])->name('admin.promocode.destroy'); 
Route::middleware('auth:admin')->get('admin/promocode-list', [PromocodeController::class, 'getPromocode'])->name('admin.promocode.getPromocode');
Route::middleware('auth:admin')->post('/send-promo-email', [PromocodeController::class, 'sendPromoEmail'])->name('send.promo.email');
Route::middleware('auth:admin')->post('admin/review-feedback', [AdminController::class, 'ReviewFeedbackstore'])->name('admin.review.feedback'); 
Route::middleware('auth:admin')->get('admin/review-feedback-list', [AdminController::class, 'reviewFeedback_list'])->name('admin.reviewFeedback_list');
Route::middleware('auth:admin')->get('admin/review-feedback-getUser', [AdminController::class, 'getreviewFeedback_list'])->name('admin.getreviewFeedback_list');
Route::middleware('auth:admin')->get('admin/reviewed-feedback-getUser', [AdminController::class, 'getreviewedFeedback_list'])->name('admin.getreviewedFeedback_list');

Route::post('/admin/users/{id}/send-temp-password', [AdminController::class, 'sendTemporaryPassword'])->name('admin.sendTemporaryPassword');

Route::prefix('admin')->group(function () {
    Route::get('/',[AdminController::class,'login_form'])->name('login.form');
    Route::get('login',[AdminController::class,'login_form'])->name('login.form');
    Route::get('/notifications', [AdminNotificationController::class, 'fetchNotifications'])->name('admin.notifications.fetch');
    Route::post('/notifications/mark-read', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');

    Route::get('/forgot-password', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'showForgotForm'])->name('admin.forgot.password.form');
    Route::post('/forgot-password', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'sendResetLink'])->name('admin.forgot.password.send');
    Route::get('/reset-password/{token}', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'showResetForm'])->name('admin.password.reset.form');
    Route::post('/reset-password', [App\Http\Controllers\Admin\ForgotPasswordController::class, 'resetPassword'])->name('admin.password.reset');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('legal-contents', [LegalContentController::class, 'index'])->name('legal-contents.index');
    Route::get('legal-contents/create', [LegalContentController::class, 'create'])->name('legal-contents.create');
    Route::post('legal-contents', [LegalContentController::class, 'store'])->name('legal-contents.store');
    Route::get('legal-contents/{id}/edit', [LegalContentController::class, 'edit'])->name('legal-contents.edit');
    Route::put('legal-contents/{id}', [LegalContentController::class, 'update'])->name('legal-contents.update');
    Route::delete('legal-contents/{id}', [LegalContentController::class, 'destroy'])->name('legal-contents.destroy');
    Route::get('legal-contents/{id}', [LegalContentController::class, 'show'])->name('legal-contents.show');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::post('quotes', [QuoteController::class, 'store'])->name('quotes.store');
});


Route::get('/paypal/create-payment/{id}', [PayPalController::class, 'createPaymentPayPal'])->name('paypal.create');
Route::get('/paypal/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'paymentFailure'])->name('paypal.cancel');



Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
Route::post('/promocode/apply', [PromocodeController::class, 'apply'])->name('promocode.apply');

Route::get('/privacy-policy', [UpdateUserProfileController::class, 'privacy'])->name('privacy');
Route::get('/term&condition', [UpdateUserProfileController::class, 'termCondition'])->name('term&condition');


Route::get('/send-profile-emails', function () {
    Artisan::call('send:profile-emails');
    return "Profile emails have been sent.";
});


Route::get('/send-reminder-profile-emails', function () {
    Artisan::call('send:reminder-profile-emails');
    return "Profile emails have been sent.";
});

Route::get('/ask-about-meeting', function () {
    Artisan::call('send:ask-about-meeting');
    return "Ask about meeting emails have been sent.";
});

Route::get('/check-subscription', function () {
    Artisan::call('subscription:check-end-date');
    return "check-subscription";
});
Route::get('/complete-reminder', function () {
    Artisan::call('reminders:send');
    return "check-subscription";
});

Route::get('/follow-up', function(){
    Artisan::call('reminders:follow-up');
    return "follow-up-connections";
});

Route::get('/test-whatsapps', function () {
    $result = sendWhatsAppMessage("+918319326980", "Hello! This is a test message.");
    dd($result); 
});

Route::get('/test-textMessage', function () {
    $result = sendTelerivetSms("+918423105603", "Hello! This is a test message.");
    dd($result); 
});

Route::get('/mobile-sms', function(){
    $result =Artisan::call('sms:send');
    dd($result); 
});

Route::get('/mastering', function () {
    return view('emails/feedback_pending');
});

Route::get('/test-mail', function () {
    return view('emails/new_profiles');
});

Route::get('/test-page', function () {
    // return view('account_rejected');
    return view('errors/500');

});

Route::get('switch-lang', function (\Illuminate\Http\Request $request) {
    $lang = $request->lang;
    if (in_array($lang, ['en', 'es'])) {
        session(['locale' => $lang]);
        App::setLocale($lang);

        if (Auth::check()) {
            $user = Auth::user();
            $user->local = $lang;
            $user->save();
        }
    }
    return redirect()->back();
})->name('lang.switch');


Route::get('/data-reset-link', function () {
    Artisan::call('send:ask-about-meeting');
    return "Data reset successfully.";
});
