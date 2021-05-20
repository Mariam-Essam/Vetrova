<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected   $table = "orders";

    protected   $dates = [ "start_at" ];

    public function products(){
        return $this->hasMany("App\Cart", "order_id", "id");
    }


    public function getFeesAttribute(){
        if($this->attributes['shipping'] == 1){
            return 100;
        } else if ($this->attributes['shipping'] == 3){
            return 50;
        } else {
            return 25;
        }
    }


    /**
     * Get the finish date
     */
    public function getFinishAtAttribute(){
        $finishDate = new Carbon($this->attributes["created_at"]);
        $finishDate->addDays($this->attributes["shipping"]);

        return $finishDate;
    }

    /**
     * Return progress value
     */
    public function getProgressAttribute(){
        
        $createdAt = new Carbon($this->attributes["start_at"]);

        $finishDate = new Carbon($this->attributes["start_at"]);
        $finishDate->addDays($this->attributes["shipping"]); // Add shipping values

        $now = Carbon::now();

        $total = $finishDate->diffInHours($createdAt);
        $pass = $createdAt->diffInHours($now);

        // dd($total . " " . $pass);
        $progress = ($pass / $total) * 100;
        $progress = $progress > 100 ? 100 : $progress;
        $progress = intval($progress);
        

        return $progress;
    }
}
