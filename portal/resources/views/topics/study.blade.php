<x-ux::layouts.page :title="__('Lesson Notes')">
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

    <x-ux::actions search>
        {{-- <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'topics.save')"/> --}}
        {{-- <x-ux::link icon="plus-square fa-3x" href="{{url('/classa') }}/0"/>
        <x-ux::action-dropdown key="sort"/> --}}
        {{-- <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>

  <br>
  
<x-ux::list> 
    <div class="row"> 
    @foreach($topics as $topic)
        <div class="col-md-4"> 

        <a wire:click.prevent="$emit('showModal', 'topics.read', {{ $topic->id }})"> 
            <div class="our_solution_category">
                <div class="solution_cards_box">
                  <div class="solution_card">
                    <div class="hover_color_bubble"></div>
                    
                    <div class="solu_title">
                <h1>{{ $topic->name }}</h1>
              </div>
              <div class="solu_description">
                <p>
                    @foreach ($getSub as $key => $name)
                    @if ($topic->subject_id == $name )
                    <x-ux::item :data="$key"/>                                            
                    @endif
                @endforeach                
@php
    if($topic->term=='1'){$den="1st Term";}
    elseif($topic->term=='2'){$den="2nd Term";}
    elseif($topic->term=='3'){$den="3rd Term";}
    else{$den="";}
@endphp
                @foreach ($getClass as $key => $name)
                    @if ($topic->class_id == $name )
                        <x-ux::item icon="graduation-cap" iconColor="primary" :data="$key"/> {{ $den }}     
                    @endif
                @endforeach
                </p>
                
                <x-ux::action icon="book-open fa-2x" :title="__('Read')" click="$emit('showModal', 'topics.read', {{ $topic->id }})" class="read_more_btn"/>

              </div>
              </div>
              </div>
            </div> </a>
        </div>
 @endforeach
</div>

    </x-ux::list>


    <x-ux::pagination :links="$topics"/>
</x-ux::layouts.page>
