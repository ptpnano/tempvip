<?php

namespace App\Livewire;

use App\Models\Accounts;
use App\Models\Emails;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AccountsController extends Component
{
    use WithPagination;
    #[Session(key: 'token')]
    //#[Session(key: 'mail')]
    //public $ss;

    public $token;
    public $mail;
    public $email;
    public $tms = true;
    public $show_create = "0";
    
    public $domain="";
    public $username="";
    public $listdomains = ["boxmails.net", "mail24h.store", "gmail79.store"];

    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public function render(Request $request)
    {
        //dd($this->token);
        if(!empty($request->session()->get('token'))){
            $this -> token = $request->session()->get('token');
            //dd($request->session()->get('token'));
        }
        
        if($this -> token == null){
            //$this-> token = collect(['cur' => '', 'emails' => []]);
            $this->token['cur']='';
            $this->token['emails']=[];
            //dd($this->token);
        }
        //dd($this -> token);
        //Session::put('mail', "tms");
        //dd($this -> token);
        //$accounts = Accounts::all()->where('email','=',$this->token['cur']);
        $listemails = Emails::all()->where('email','=',$this->token['cur']);

        //dd($accounts);
        //return view('livewire.accounts-controller');
        //dd($this -> token);
        $this -> mail = $this->token['cur'];
        if(empty($this -> mail)){
            $this -> show_create="1";
            //dd($this -> mail);
        }

        return view('livewire.accounts-controller', [
            //'accounts' => $accounts,
            'listemails' => $listemails,
            'listdomains' => $this -> listdomains,
        ]);
    }

    public function refreshComponent(){
        //$accounts = Accounts::all()->where('email','=',$this->token['cur']);
        
        //dd($accounts);
        //return view('livewire.accounts-controller');
        //dd($this -> token);
        // return view('livewire.accounts-controller', [
        //     'accounts' => $accounts,
        // ]);
    }

    public function show(Request $request, $mail)
    {
        //dd($this -> token);
        //$accounts = Accounts::all();
        //dd($accounts);
        //return view('livewire.accounts-controller');
        // return view('livewire.accounts-controller', [
        //     'accounts' => $accounts,
        //     'mail' => $mail,
        // ]);

        if(empty($request->session()->get('token'))){
            //dd($request->session()->get('token'));
            return redirect('/inbox');
        }

        $this -> token = $request->session()->get('token');
        //dd($this->token);
        // ton tai email
        
        if(in_array($mail, $this->token['emails'])){
            $tmp = array_search($mail, $this->token['emails']);
            $this -> token['cur'] = $this->token['emails'][$tmp];
            //dd($this-> token['cur']);
        }
        //dd($this->token);
        //return redirect('/inbox')->with('token' , $this-> token);
        //return $this->redirectRoute('inbox',['token'=>$this->token]);
        session()->put('token',$this -> token);
        return redirect('/inbox');
    }

    public function save()
    {
        if(count($this->token['emails'] ?? [])>=10){
            return redirect()->to('/inbox');
        }
        if(!empty($this -> username) && !empty($this -> domain)){
            $this -> email = $this -> username . "@" . $this -> domain;
            //dd($this -> domain);
            $this -> mail = $this -> email;
            $this -> token['cur'] = $this -> email;
            if (!in_array($this -> email, $this -> token['emails'] ?? []))
            {
                $this -> token['emails'][] = $this -> email; 
                //$this -> ss -> token = $this -> token;
            }
            //$this -> token -> push($this -> email);
            //$this -> token = $this -> email;
            return redirect()->to('/inbox');
        }
        
    }

    public function save_random()
    {
        $this -> username = Str::lower(Str::random(rand(12,20)));
        $this -> domain = $this-> listdomains[array_rand($this-> listdomains)];
        return $this -> save();
    }

    public function remove()
    {
        //dd($this -> token);
        $name = $this -> token['cur'];
        if(!empty($name)){
            //dd($name);
            $temp = $this -> token['emails'];
            unset($temp[array_search($name, $temp)]);
            if(count($temp)>0){
                $this -> token['cur']= head($temp);
            }else{
                $this -> token['cur']= '';
            }
            $this -> token['emails'] = $temp;       
        }
        return redirect()->to('/inbox');
    }

    public function setDomain($dm)
    {
        //dd($dm);
        $this -> domain = $dm;
    }
}
