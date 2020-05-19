<?php

namespace Application\Controllers;

use Illuminate\Http\Request;
use Application\Models\Meal;
use Session;
use Application\Models\Cart;
use Slim\Views\Twig as View;
use Application\Controllers\Controller;


class MealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($request, $response)
    {
      // $data = Meal::all();
      $meals = ["hello", "bye"];
      return $this->container->view->render($response, 'meals.twig', $meals);


    }

// public function addToCart($id){
//     $meal = Meal::find($id);
//     $oldCart = Session::has('cart') ? Session::get('cart') : null;
//     $cart = new Cart($oldCart);
//     $cart->add($meal, $product->id);
//
//     $request->session()->put('cart', $cart);
//    return redirect()->back()->with('success', 'Meal added to cart successfully!');
// }



    public function addToCart($id){
     $meal = Meal::find($id);
     if(!$meal) {
         abort(404);
     }

     $cart = session()->get('cart');

     if(!$cart) {

         $cart = [
                 $id => [
                     "name" => $meal->meal_name,
                     "quantity" => 1,
                     "price" => $meal->price,
                 ]
         ];
         session()->put('cart', $cart);

         return redirect()->back()->with('success', 'Meal added to cart successfully!');
       }

         if(isset($cart[$id])) {

             $cart[$id]['quantity']++;

             session()->put('cart', $cart);

             return redirect()->back()->with('success', 'Meal added to cart successfully!');
           }

           $cart[$id] = [
             "name" => $meal->meal_name,
             "quantity" => 1,
             "price" => $meal->price,
         ];

         session()->put('cart', $cart);

         return redirect()->back()->with('success', 'Meal added to cart successfully!');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'text' => 'required'
      ]);

      if($validator->fails()){
        $response = array('response' => $validator->messages(), 'success' => false);
        return $response;
      } else {
        // adding meals
        $meal = new Meal;
        $meal->meal_name = $request->input('meal_name');
        $meal->meal_desc = $request->input('meal_desc');
        $meal->price = $request->input('price');
        $meal->is_in_daily = $request->input('is_in_daily');
        $meal->save();

        return response()->json($meal);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $meal = Meal::find($id);
        return response()->json($meal);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request)
         {
             if($request->id and $request->quantity)
             {
                 $cart = session()->get('cart');

                 $cart[$request->id]["quantity"] = $request->quantity;

                 session()->put('cart', $cart);

                // session()->flash('success', 'Cart updated successfully');
             }
         }


    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

          //  session()->flash('success', 'Product removed successfully');
        }
    }



    // public function updateTheMeal(Request $request, $id)
    // {
    //     //
    //
    //     $validator = Validator::make($request->all(),[
    //       'text' => 'required'
    //     ]);
    //
    //     if($validator->fails()){
    //       $response = array('response' => $validator->messages(), 'success' => false);
    //       return $response;
    //     } else {
    //       // updating a meal
    //       $meal = Meal::find($id);
    //       $meal->meal_name = $request->input('meal_name');
    //       $meal->meal_desc = $request->input('meal_desc');
    //       $meal->price = $request->input('price');
    //       $meal->is_in_daily = $request->input('is_in_daily');
    //       $meal->save();
    //
    //       return response()->json($meal);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deleting the meal
        $meal = Meal::find($id);
        $meal->delete();

        $response = array('response' => 'Meal deleted', 'success' => true);
        return $response;
    }
}
