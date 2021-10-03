<?php

namespace App\Http\Controllers;

use App\Models\url;
use App\Models\robotVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class urlController extends Controller{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('url.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        /*Validação dos dados do formulário*/
            $regras = [
                        'url' => 'required|url|unique:url,url'
                      ];

            $feedback = [
                            'required'  => 'Preenchimento obrigatório',
                            'url'       => 'Formato de url inválido',
                            'url.unique'=> 'Url já cadastrada'
                        ];

            $validator = Validator::Make($request->all(), $regras, $feedback);

            if($validator->fails()){
                parent::flashSuccess("Sucesso", "Erro ao cadastrar nova url", "success", false, 1500);
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
        /*Validação dos dados do formulário*/

        /*Verificando o status code da url*/
           /* $status_code = self::ConsultarStatusCode($request->get('url'));
            
            if($status_code >= 400 && $status_code <= 451){
                parent::flashSuccess("Sucesso", "Erro ao cadastrar nova url, status: ".$status_code, "success", false, 1500);
                return redirect()->back();
            }*/
        /*Verificando o status code da url*/

        /*Cadastrando a nova url*/
            url::create([
                            'users_id'  => auth()->user()->id,
                            'url'       => $request->get('url')
                        ]);
        /*Cadastrando a nova url*/

        parent::flashSuccess("Sucesso", "Url Cadastrada com sucesso", "success", false, 1500);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('url.atualizar',[
                                        'url' => url::find(decrypt($id))
                                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        /*Validação dos dados do formulário*/
            $regras = [
                        'url' => 'required|url|unique:url,url,'.decrypt($id)
                      ];

            $feedback = [
                            'required'  => 'Preenchimento obrigatório',
                            'url'       => 'Formato de url inválido',
                            'url.unique'=> 'Url já cadastrada'
                        ];

            $validator = Validator::Make($request->all(), $regras, $feedback);

            if($validator->fails()){
                parent::flashSuccess("Sucesso", "Erro ao cadastrar nova url", "success", false, 1500);
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
        /*Validação dos dados do formulário*/

        /*Verificando o status code da url*/
            $status_code = self::ConsultarStatusCode($request->get('url'));
            
            if($status_code >= 400 && $status_code <= 451){
                parent::flashSuccess("Sucesso", "Erro ao cadastrar nova url, status: ".$status_code, "success", false, 1500);
                return redirect()->back();
            }
        /*Verificando o status code da url*/

        /*Atualizando a nova url, como o endereço é outro, então a contagem retorna em 0*/
            url::where('id', decrypt($id))
                ->update([                            
                            'url'       => $request->get('url'),
                            'status'    => $status_code
                        ]);
        /*Atualizando a nova url, como o endereço é outro, então a contagem retorna em 0*/

        parent::flashSuccess("Sucesso", "Url atualizada com sucesso", "success", false, 1500);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        robotVerification::where('url_id',decrypt($id))->delete();
        url::find(decrypt($id))->delete();

        parent::flashSuccess("Sucesso", "Url deletada com sucesso", "success", false, 1500);
        return redirect()->route('home');
    }

    public function refresh(Request $request){

        return response()->json([
                                    'success'     => 1,
                                    'status_code' => url::where('users_id', auth()->user()->id)
                                                     ->select('id','status')
                                                     ->get()
                                ]);
    }

    private function ConsultarStatusCode($url){
        $ch = curl_init($url);        
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode;
    }
}
