<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Post;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Request as RequestModel;

class UserController extends Controller
{
    /**
     * Show profile view
     */
    public function profile(Request $request){
        $user = Auth::user();

        if($user->type == "admin"){
            return $this->admin($user);
        } else if ($user->type == "designer"){
            return $this->designer($user);
        } else {
            return $this->customer($user, $request);
        }
        
    }

    /**
     * Admin profile
     */
    public function admin($user){

        $posts = Post::where("active", "!=", 1)->paginate();
        
        return view("admin.dashboard", compact("user", "posts"));
    }
    
    
     /**
     * Designer profile
     */
    public function designer($user){
        $categories = Category::with("types")->get();
        $posts = Auth::user()
                            ->posts()
                            ->orderBy("created_at", "DESC")
                            ->with(["category", "type", "products"])
                            ->paginate();
        $numberOfFollowers = $user->followers()->count();
        
        $requests = RequestModel::where("designer_id", Auth::id())
                                ->with(["product", "customer"])
                                ->get();
        
        return view("profile.designer", compact("user", "categories", "posts", "numberOfFollowers", "requests"));
    }
    
    /**
     * Customer profile
     */
    public function customer($user, Request $request){
        // $posts = $user->follow_posts()
        //                 ->where("active", "=", true)
        //                 ->orderBy("created_at", "DESC")
        //                 ->with(["category", "type", "user", "products"])
        //                 ->paginate();

        $requests = RequestModel::where("customer_id", Auth::id())
                                ->with(["product", "designer"])
                                ->get();


        $categories = Category::with("types")->get();
        $cats = $request->categories ?? []; 
        $types = $request->types ?? [];


        $posts = $this->generateQuery($user, $request)->paginate();
        

        return view("profile.customer", compact("posts", "user", "requests", "categories", "cats", "types"));
    }



    /**
     * Update user settings
     */
    public function settings(Request $request){
        
        $user = Auth::user();

        if($user->type == "designer"){
            return $this->designerSettings($request);
        }


        // Validate the request
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);


        

        $filePath = $user->image;
        if($request->image){
            // Delete old one
            Storage::delete($filePath);
            // Upload
            $filePath = $request->image->store("public/images");
        }



        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->image = $filePath;

        $user->save();

        Session::flash("success", "Your settings updated successfully");

        return redirect()->route("profile");
    }


    /**
     * Edit designer profile
     */
    public function designerSettings(Request $request){
        // Validate the request
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'governorate' => 'nullable|string|max:20',
            'about' => 'nullable|string',
            'phone' => 'nullable|string',
            'day' => 'nullable|required_with:month,year|string',
            'month' => 'nullable|required_with:day,year|string',
            'year' => 'nullable|required_with:day,month|string',
        ]);

        $user = Auth::user();

        

        $filePath = $user->image;
        if($request->image){
            // Delete old one
            Storage::delete($filePath);
            // Upload
            $filePath = $request->image->store("public/images");
        }



        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->image = $filePath;
        $user->governorate = $request->governorate;
        $user->about = $request->about;
        $user->phone = $request->phone;
        $user->day = $request->day;
        $user->month = $request->month;
        $user->year = $request->year;

        $user->save();

        Session::flash("success", "Your settings updated successfully");

        return redirect()->route("profile");
    }


    /**
     * Designer Profile
     */
    public function designerProfile(User $user){

        $posts = $user->posts()
                    ->orderBy("created_at", "DESC")
                    ->with(["category", "type", "products"])
                    ->paginate();
        
        $followed = $user->followers()->where("customer_id", Auth::id())->count() > 0;
        $designer = $user;
        $numberOfFollowers = $user->followers()->count();
        $requests = RequestModel::where("customer_id", Auth::id())
                                ->with(["product", "designer"])
                                ->get();
        
        return view("profile.designer_customer", compact("posts", "followed", "designer", "numberOfFollowers", "requests"));
    }

    /**
     * Toggle follow
     */
    public function follow(Request $request, User $user){

        $authed = Auth::user();
        $authed->follows()->toggle($user->id);

        return redirect()->back();
    }

    /**
     * Filter query
     */
    public function generateQuery($user, $request){
        $query = $user->follow_posts()
                        ->where("active", "=", true)
                        ->orderBy("created_at", "DESC")
                        ->with(["category", "type", "user", "products"]);

        $cats = false;
        if($request->categories){
            $query->whereIn("category_id", $request->categories);
            $cats = true;
        }

        if($request->types){
            if($cats){
                $query->whereIn("type_id", $request->types);
            } else {
                $query->whereIn("type_id", $request->types);
            }
        }

        // Filter sizes
        if($request->s) $query->whereHas("products", function($q){ $q->where("s", ">", 0); return $q; });
        if($request->m) $query->whereHas("products", function($q){ $q->where("m", ">", 0); return $q; });
        if($request->l) $query->whereHas("products", function($q){ $q->where("l", ">", 0); return $q; });
        if($request->xl) $query->whereHas("products", function($q){ $q->where("xl", ">", 0); return $q; });
        if($request->xxl) $query->whereHas("products", function($q){ $q->where("xxl", ">", 0); return $q; });
        if($request->more) $query->whereHas("products", function($q){ $q->where("more", ">", 0); return $q; });
         

        return $query;
    }


}
