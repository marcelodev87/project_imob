<?php

namespace LaraDev\Http\Controllers\Web;

use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Property;
use LaraDev\Http\Controllers\Web\FilterController;

class WebController extends Controller
{
    public function home()
    {
        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            'Encontre o Imóvel dos seus sonhos',
            route('web.home'),
            asset('backend/assets/images/imob.png')
        );


        $propertiesForSale = Property::sale()->available()->limit(3)->get();
        $propertiesForRent = Property::rent()->available()->limit(3)->get();
        return view('web.home', [
            'head' => $head,
            'propertiesForSale' => $propertiesForSale,
            'propertiesForRent' => $propertiesForRent
        ]);
    }

    public function spotlight()
    {
        return view('web.spotlight');
    }

    public function rent()
    {
        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            'Alugue o Imóvel dos seus sonhos',
            route('web.rent'),
            asset('backend/assets/images/imob.png')
        );

        $filter = new FilterController();
        $filter->clearAllData();

        $properties = Property::rent()->available()->get();
        return view('web.filter', [
            'head' => $head,
            'properties' => $properties,
            'type' => 'rent'
        ]);
    }

    public function rentProperty(Request $request)
    {
        $property = Property::where('slug', $request->slug)->first();

        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            $property->headline ?? $property->title,
            route('web.rentProperty', ['property' => $property->slug ]),
            $property->cover()
        );

        return view('web.property', [
            'head' =>$head,
            'property' => $property,
            'type' => 'rent'
        ]);
    }

    public function buy()
    {
        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            'Compre o Imóvel dos seus sonhos',
            route('web.buy'),
            asset('backend/assets/images/imob.png')
        );

        $filter = new FilterController();
        $filter->clearAllData();

        $properties = Property::sale()->available()->get();
        return view('web.filter', [
            'head' => $head,
            'properties' => $properties,
            'type' => 'sale'
        ]);
    }

    public function buyProperty(Request $request)
    {
        $property = Property::where('slug', $request->slug)->first();

        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            $property->headline ?? $property->title,
            route('web.buyProperty', ['property' => $property->slug ]),
            $property->cover()
        );

        return view('web.property', [
            'head' => $head,
            'property' => $property,
            'type' => 'sale'
        ]);
    }

    public function filter()
    {
        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            'Encontre o Imóvel dos seus sonhos',
            route('web.buy'),
            asset('backend/assets/images/imob.png')
        );

        $filter = new FilterController();
        $itemProperties = $filter->createQuery('id');

        foreach ($itemProperties as $property) {
            $properties[] = $property->id;
        }

        if (!empty($properties)) {
            $properties = Property::whereIn('id', $properties)->get();
        } else {
            $properties = Property::all();
        }

        return view('web.filter', [
            'head' => $head,
            'properties' => $properties
        ]);
    }

    public function experience()
    {
        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            'Encontre o Imóvel dos seus sonhos',
            route('web.experience'),
            asset('backend/assets/images/imob.png')
        );

        $filter = new FilterController();
        $filter->clearAllData();

        $properties = Property::whereNotNull('experience')->get();

        return view('web.filter', [
            'head' => $head,
            'properties' => $properties
        ]);
    }

    public function experienceCategory(Request $request)
    {
        $filter = new FilterController();
        $filter->clearAllData();

        if ($request->slug == 'cobertura') {
            $properties = Property::where('experience', 'Cobertura')->get();

            $head = $this->seo->render(
                env('APP_NAME') . ' - Imobiliária Teste',
                'Viva a experiência de morar na cobertura dos seus sonhos',
                route('web.experienceCategory', ['category' => 'cobertura']),
                asset('backend/assets/images/imob.png')
            );
        } elseif ($request->slug == 'alto-padrao') {
            $properties = Property::where('experience', 'Alto Padrão')->get();

            $head = $this->seo->render(
                env('APP_NAME') . ' - Imobiliária Teste',
                'Viva a experiência de morar no imóvel dos seus sonhos',
                route('web.experienceCategory', ['category' => 'alto-padrao']),
                asset('backend/assets/images/imob.png')
            );
        } elseif ($request->slug == 'de-frente-para-o-mar') {
            $properties = Property::where('experience', 'De frente para o Mar')->get();

            $head = $this->seo->render(
                env('APP_NAME') . ' - Imobiliária Teste',
                'Viva a experiência de morar na casa de praia dos seus sonhos',
                route('web.experienceCategory', ['category' => 'de-frente-para-o-mar']),
                asset('backend/assets/images/imob.png')
            );
        } elseif ($request->slug == 'condominio-fechado') {
            $properties = Property::where('experience', 'Condomínio Fechado')->get();

            $head = $this->seo->render(
                env('APP_NAME') . ' - Imobiliária Teste',
                'Viva a experiência de morar no condomínio dos seus sonhos',
                route('web.experienceCategory', ['category' => 'condominio-fechado']),
                asset('backend/assets/images/imob.png')
            );
        } elseif ($request->slug == 'compacto') {
            $properties = Property::where('experience', 'Compacto')->get();

            $head = $this->seo->render(
                env('APP_NAME') . ' - Imobiliária Teste',
                'Viva a experiência de morar em um imóvel compacto',
                route('web.experienceCategory', ['category' => 'compacto']),
                asset('backend/assets/images/imob.png')
            );
        } elseif ($request->slug == 'lojas-e-salas') {
            $properties = Property::where('experience', 'Lojas e Salas')->get();

            $head = $this->seo->render(
                env('APP_NAME') . ' - Imobiliária Teste',
                'Viva a experiência de trabalhar no imóvel dos seus sonhos',
                route('web.experienceCategory', ['category' => 'lojas-e-salas']),
                asset('backend/assets/images/imob.png')
            );
        } else {
            $properties = Property::whereNotNull('experience')->get();
        }

        if(empty($head)){
            $head = $this->seo->render(
                env('APP_NAME') . ' - Imobiliária Teste',
                'Encontre o Imóvel dos seus sonhos na Capital',
                route('web.experience'),
                asset('backend/assets/images/imob.png')
            );
        }

        return view('web.filter', [
            'head' => $head,
            'properties' => $properties
        ]);
    }

    public function contact()
    {
        $head = $this->seo->render(
            env('APP_NAME') . ' - Imobiliária Teste',
            'Quer conversar com um corretor exclusivo e ter o atendimento diferenciado em busca do seu imóvel dos sonhos?',
            route('web.contact'),
            asset('backend/assets/images/imob.png')
        );
        return view('web.contact',[
            'head' => $head
        ]);
    }
}
