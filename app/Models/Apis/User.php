<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FAUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    protected $guard_name = 'web';
    use HasFactory ,HasRoles,Notifiable;
    protected $table = 'users';
    protected $fillable = ['id', 'unique_id', 'google_id', 'google_secret_key', 'factor_secret_key', 'facial_analysis_photo', 'profile_photo', 'first_name', 'last_name', 'dob', 'gender', 'nationality', 'job_experience', 'email', 'phone', 'twitter_account', 'linkedin_account', 'status', 'created_at', 'updated_at','fcm_token'];



}
