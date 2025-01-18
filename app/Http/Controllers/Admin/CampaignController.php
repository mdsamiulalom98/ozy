<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CampaignReview;
use App\Models\Campaign;
use App\Models\GeneralTable;
use Image;
use Toastr;
use Str;
use File;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $show_data = Campaign::orderBy('id','DESC')->get();
        return view('backEnd.campaign.index',compact('show_data'));
    }
    public function create()
    {
        $products = Product::where(['status'=>1])->select('id','name','status')->get();
        return view('backEnd.campaign.create',compact('products'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        
        $input = $request->except(['files','image','general_q','general_answer']);
        
        // best image
        $image1 = $request->file('best_image');
        $name1 =  time().'-'.$image1->getClientOriginalName();
        $name1 = strtolower(preg_replace('/\s+/', '-', $name1));
        $uploadPath1 = 'public/uploads/campaign/';
        $image1->move($uploadPath1,$name1);
        $imageUrl1 =$uploadPath1.$name1;

        $input['slug'] = strtolower(Str::slug($request->name));
        $input['best_image'] = $imageUrl1;

         // choose_image
        $image2 = $request->file('choose_image');
        $name2 =  time().'-'.$image2->getClientOriginalName();
        $name2 = strtolower(preg_replace('/\s+/', '-', $name2));
        $uploadPath2 = 'public/uploads/campaign/';
        $image2->move($uploadPath2,$name2);
        $imageUrl2 =$uploadPath2.$name2;

        $input['slug'] = strtolower(Str::slug($request->name));
        $input['choose_image'] = $imageUrl2;
   
         // useful_image
        $image3 = $request->file('useful_image');
        $name3 =  time().'-'.$image3->getClientOriginalName();
        $name3 = strtolower(preg_replace('/\s+/', '-', $name3));
        $uploadPath3 = 'public/uploads/campaign/';
        $image3->move($uploadPath3,$name3);
        $imageUrl3 =$uploadPath3.$name3;

        $input['slug'] = strtolower(Str::slug($request->name));
        $input['useful_image'] = $imageUrl3;


        // return $imageUrl1;

        $campaign = Campaign::create($input); 
          // return $request->all();
        

        $images = $request->file('image');
        if($images){
            foreach ($images as $key => $image) {
                $name =  time().'-'.$image->getClientOriginalName();
                $name = strtolower(preg_replace('/\s+/', '-', $name));
                $uploadPath = 'public/uploads/campaign/';
                $image->move($uploadPath,$name);
                $imageUrl =$uploadPath.$name;

                $pimage             = new CampaignReview();
                $pimage->campaign_id = $campaign->id;
                $pimage->image       = $imageUrl;
                $pimage->save();
            }
            
        }  

         // Save General Questions and Answers in GeneralTable
        $generalQuestions = $request->input('general_q', []); 
        $generalAnswers = $request->input('general_answer', []); 

        if (!empty($generalQuestions) && !empty($generalAnswers)) {
            foreach ($generalQuestions as $key => $question) {
                if (!empty($question) && isset($generalAnswers[$key])) {
                    GeneralTable::create([
                        'campaign_id' => $campaign->id,
                        'question' => is_array($question) ? json_encode($question) : $question, // Convert array to JSON if necessary
                        'answer' => is_array($generalAnswers[$key]) ? json_encode($generalAnswers[$key]) : $generalAnswers[$key], // Convert array to JSON if necessary
                    ]);
                }
            }
        }


         // dd($request->all())
        // dd($request->all());
        //return $request->all();     
        
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('campaign.index');
    }
    
    public function edit($id)
    {
        $edit_data = Campaign::with('images')->find($id);
        $slug = $edit_data->slug;

        $campaign = Campaign::with('generalTable')->where('slug', $slug)->first();
        $select_products = Product::where('campaign_id',$id)->get();
        $show_data = Campaign::orderBy('id','DESC')->get();
        $products = Product::where(['status'=>1])->select('id','name','status')->get();
        return view('backEnd.campaign.edit',compact('edit_data','products','select_products','campaign'));
    }
    
    public function update(Request $request)
    { 
        $this->validate($request, [
            'status' => 'required',
        ]);
        // return $request->all();
        // image one
        $update_data = Campaign::find($request->hidden_id);
        $input = $request->except('hidden_id','product_ids','files','image','general_q','general_answer');
        
        $image1 = $request->file('best_image');
        if($image1){
            $image1 = $request->file('best_image');
            $name1 =  time().'-'.$image1->getClientOriginalName();
            $name1 = strtolower(preg_replace('/\s+/', '-', $name1));
            $uploadPath1 = 'public/uploads/campaign/';
            $image1->move($uploadPath1,$name1);
            $imageUrl1 =$uploadPath1.$name1;
            File::delete($update_data->best_image);
            $input['best_image'] = $imageUrl1;
        }else{
            $input['best_image'] = $update_data->best_image;
        }

        $image2 = $request->file('choose_image');
        if($image2){
            $image2 = $request->file('choose_image');
            $name2 =  time().'-'.$image2->getClientOriginalName();
            $name2 = strtolower(preg_replace('/\s+/', '-', $name2));
            $uploadPath2 = 'public/uploads/campaign/';
            $image2->move($uploadPath2,$name2);
            $imageUrl2 =$uploadPath2.$name2;
            File::delete($update_data->choose_image);
            $input['choose_image'] = $imageUrl2;
        }else{
            $input['choose_image'] = $update_data->choose_image;
        }

        $image3 = $request->file('useful_image');
        if($image3){
            $image3 = $request->file('useful_image');
            $name3 =  time().'-'.$image3->getClientOriginalName();
            $name3 = strtolower(preg_replace('/\s+/', '-', $name3));
            $uploadPath3 = 'public/uploads/campaign/';
            $image3->move($uploadPath3,$name3);
            $imageUrl3 =$uploadPath3.$name3;
            File::delete($update_data->useful_image);
            $input['useful_image'] = $imageUrl3;
        }else{
            $input['useful_image'] = $update_data->useful_image;
        }


        $input['slug'] = strtolower(Str::slug($request->name));
        $update_data = Campaign::find($request->hidden_id);
        $update_data->update($input);

        $images = $request->file('image');  
        if($images){
            foreach ($images as $key => $image) {
                $name =  time().'-'.$image->getClientOriginalName();
                $name = strtolower(preg_replace('/\s+/', '-', $name));
                $uploadPath = 'public/uploads/campaign/';
                $image->move($uploadPath,$name);
                $imageUrl =$uploadPath.$name;

                $pimage             = new CampaignReview();
                $pimage->campaign_id = $update_data->id;
                $pimage->image      = $imageUrl;
                $pimage->save();
            }
        }


         // Update General Questions and Answers
        GeneralTable::where('campaign_id', $update_data->id)->delete(); // Remove old entries

        $generalQuestions = $request->input('general_q', []);
        $generalAnswers = $request->input('general_answer', []);
        if (!empty($generalQuestions) && !empty($generalAnswers)) {
            foreach ($generalQuestions as $key => $question) {
                if (!empty($question) && isset($generalAnswers[$key])) {
                    GeneralTable::create([
                        'campaign_id' => $update_data->id,
                        'question' => $question,
                        'answer' => $generalAnswers[$key],
                    ]);
                }
            }
        }
        

        Toastr::success('Success','Data update successfully');
        return redirect()->route('campaign.index');
        
}
    
    
 
    public function inactive(Request $request)
    {
        $inactive = Campaign::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Campaign::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
       
        $delete_data = Campaign::find($request->hidden_id);
        $delete_data->delete();
        
        $campaign = Product::whereNotNull('campaign_id')->get();
        foreach($campaign as $key=>$value){
            $product = Product::find($value->id);
            $product->campaign_id = null;
            $product->save();
        }
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
    public function imgdestroy(Request $request)
    { 
        $delete_data = CampaignReview::find($request->id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    } 
}
