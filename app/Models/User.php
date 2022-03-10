<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function allUsers() {
        $users = User::all();
        foreach($users as $user) {
            $user['projectsPublished'] = self::userProjects($user['id']);
            $response[] = $user;
        }
        return $response;
    }
    
    public static function userProjects($id) {
        $projects = null;
        $user_projects = Project::select('id','title','publishedDate','deadline','shortExplanation','state','bid')->where('user_id',$id)->get();
        foreach($user_projects as $user_project) {
            $projects[] = $user_project;
        }
        return $projects;
    }    

}
