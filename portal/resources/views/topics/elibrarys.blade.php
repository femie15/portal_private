<x-ux::layouts.page :title="__('eLibrary')">
    <style>
        .section_our_solution .row {
      align-items: center;
    }
    
    .our_solution_category {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
    }
    .our_solution_category .solution_cards_box {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .solution_cards_box .solution_card {
      flex: 0 50%;
      background: #fff;
      box-shadow: 0 2px 4px 0 rgba(136, 144, 195, 0.2),
        0 5px 15px 0 rgba(37, 44, 97, 0.15);
      border-radius: 15px;
      margin: 8px;
      padding: 10px 15px;
      position: relative;
      z-index: 1;
      overflow: hidden;
      min-height: 265px;
      transition: 0.7s;
    }
    
    .solution_cards_box .solution_card:hover {
      background: #309df0;
      color: #fff;
      transform: scale(1.1);
      z-index: 9;
    }
    
    .solution_cards_box .solution_card:hover::before {
      background: rgb(85 108 214 / 10%);
    }
    
    .solution_cards_box .solution_card:hover .solu_title h3,
    .solution_cards_box .solution_card:hover .solu_description p {
      color: #fff;
    }
    
    .solution_cards_box .solution_card:before {
      content: "";
      position: absolute;
      background: rgb(85 108 214 / 5%);
      width: 170px;
      height: 400px;
      z-index: -1;
      transform: rotate(42deg);
      right: -56px;
      top: -23px;
      border-radius: 35px;
    }
    
    .solution_cards_box .solution_card:hover .solu_description button {
      background: #fff !important;
      color: #309df0;
    }
    
    .solution_card .so_top_icon {
    }
    
    .solution_card .solu_title h3 {
      color: #212121;
      font-size: 2.3rem;
      margin-top: 13px;
      margin-bottom: 13px;
    }
    
    .solution_card .solu_description p {
      font-size: 19px;
      margin-bottom: 45px;
    }
    
    .solution_card .solu_description button {
      border: 0;
      border-radius: 15px;
      background: linear-gradient(
        140deg,
        #42c3ca 0%,
        #42c3ca 50%,
        #42c3cac7 75%
      ) !important;
      color: #fff;
      font-weight: 500;
      font-size: 1.5rem;
      padding: 5px 46px;
    }
    
    .our_solution_content h1 {
      text-transform: capitalize;
      margin-bottom: 1rem;
      font-size: 2.5rem;
    }
    .our_solution_content p {
    }
    
    .hover_color_bubble {
      position: absolute;
      background: rgb(54 81 207 / 15%);
      width: 100rem;
      height: 100rem;
      left: 0;
      right: 0;
      z-index: -1;
      top: 16rem;
      border-radius: 50%;
      transform: rotate(-36deg);
      left: -18rem;
      transition: 0.7s;
    }
    
    .solution_cards_box .solution_card:hover .hover_color_bubble {
      top: 0rem;
    }
    
    .solution_cards_box .solution_card .so_top_icon {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: #fff;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .solution_cards_box .solution_card .so_top_icon img {
      width: 40px;
      height: 50px;
      object-fit: contain;
    }
    
    /*start media query*/
    @media screen and (min-width: 320px) {
      .sol_card_top_3 {
        position: relative;
        top: 0;
      }
    
      .our_solution_category {
        width: 100%;
        margin: 0 auto;
      }
    
      .our_solution_category .solution_cards_box {
        flex: auto;
      }
    }
    @media only screen and (min-width: 768px) {
      .our_solution_category .solution_cards_box {
        flex: 1;
      }
    }
    @media only screen and (min-width: 1024px) {
      .sol_card_top_3 {
        position: relative;
        top: -3rem;
      }
      .our_solution_category {
        width: 100%;
        margin: 0 auto;
      }
    }    
    </style>
{{-- <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}"> --}}

<br>

<div class="col-md-12"> <div class="panel minimal minimal-gray"> 
  
    <div class="panel-heading"> 
  <div class="panel-title">  {{-- <h4>Minimal Panel</h4> --}}</div> 
  <div class="panel-options"> 
    <center>
    <ul class="nav nav-tabs"> 
    <li class="active">
      {{-- <x-ux::button :label="__('Login')" type="submit" href="#profile-1"/> --}}
      <a href="#profile-1" data-toggle="tab" aria-expanded="true" class="btn btn-primary">eBooks</a>
    </li> 
    <li class=""> 
      &emsp;&emsp;
      <a href="#profile-2" data-toggle="tab" aria-expanded="false" class="btn btn-primary">Past Questions</a>
    </li> </ul> 
  </center>
  </div> 
</div> 

<div class="panel-body"> <div class="tab-content"> 
  <div class="tab-pane active" id="profile-1"> 
    {{-- 1 --}}
    <center><h2>eBooks</h2></center> 

    <x-ux::actions search>
    </x-ux::actions>

  <br>  
<x-ux::list> 
          <div class="row"> 
          @foreach($topics as $topic)
              <div class="col-md-3"> 
                <x-ux::image src="{{ url('library/ebook/images/agric.jpg') }}" fluid thumbnail/>
              </div>
      @endforeach
      </div>
    </x-ux::list>
</div> 

<div class="tab-pane" id="profile-2"> 
  {{-- 2 --}}
  <center><h2>Past Questions</h2></center> 
  <x-ux::actions search>
  </x-ux::actions>

<br>  
<x-ux::list> 
      <div class="row"> 
      @foreach($topics as $topic)
          <div class="col-md-3">   
            <x-ux::image src="{{ url('library/ebook/images/agric.jpg') }}" fluid thumbnail/>              
          </div>
    @endforeach
    </div>
  </x-ux::list>
</div> 

</div> </div> </div> </div>



    <x-ux::pagination :links="$topics"/>
</x-ux::layouts.page>
