<?php

namespace App;

use App\Scope\EntranceYearScope;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Eloquent;

class User extends Eloquent
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'username', 'first_name', 'last_name', 'sex', 'mobile', 'others'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // articles written for this user
    public function texts()
    {
        return $this->hasMany(Article::class, 'texter_id');
    }


    //counts
    public function writtenArticlesCount()
    {
        return $this->hasMany(Article::class)->where('cover', 'exists', false)->count();
    }

    public function writtenCoversCount()
    {
        return $this->hasMany(Article::class)->where('cover', 1)->count();
    }

    public function articlesCount()
    {
        return $this->hasMany(Article::class, 'texter_id')->where('cover', 'exists', false)->count();;
    }

    public function coversCount()
    {
        return $this->hasMany(Article::class, 'texter_id')->where('cover', 1)->count();;
    }

    public function isAdmin($type = 'admin')
    {
        $admins = [];
        switch ($type) {
            case 'admin':
                $admins = admins();
                break;
            case 'journal':
                $admins = journal_admins();
                break;
            case 'secret':
                $admins = secret_admins();
                break;
        }
        if ($this['username'] && $admins->contains($this->username))
            return true;
        return false;
    }


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        //   static::addGlobalScope(new EntranceYearScope());
    }

    public function scopeMain($query)
    {
        return $query->where('others', 'exists', false);
    }
}
