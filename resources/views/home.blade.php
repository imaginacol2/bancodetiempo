@extends('layouts.app')

@section('content')
<div class="collageHome">
    <div class="actions">
        <div class="form">
            Comparte y aprende de manera colaborativa
            @if (Auth::guest())
                <div>
                    <button class="btn btn-danger assist" assistID="0">Ingresar</button>
                </div>
            @endif
            <div>
                <button class="btn btn-primary" id="findactivity">Encontrar</button>
            </div>
        </div>
    </div>
</div>


<div id="activitycontainer">
    @if(count($activities)>0)
    <h1>Proximas Actividades</h1>
    @endif
    <div class="activitylist">
        <div class="activitylistwrapper">
            @foreach ($activities as $activity)
                    <div class="activitymain">
                        @if ($activity->hasimage)
                            <div class="activityimage">
                                <img src="/assets/activities/{{$activity->id}}.jpg" />
                            </div>
                        @else
                            <div class="activityimage">
                                <img src="/assets/categories/{{$activity->category->category}}.jpg" />
                            </div>
                        @endif
                        <div class="informationwrapper"></div>
                        <div class="leftInformation">
                            <div class="date">
                                <div class="day">
                                    <span>
                                        {{$activity->time[0]}}
                                    </span>
                                    {{$activity->time[1]}}
                                </div>
                                <div class="mounth">
                                    {{$activity->time[2]}}
                                </div>
                            </div>
                            <div class="place">
                                {{$activity->place}}
                            </div>

                        </div>

                        <div class="rightInformation">
                            <h3 class="title">
                                <a href="/activity/{{$activity->slug}}/{{$activity->id}}">{{$activity->title}}</a>
                            </h3>
                        </div>


                        <div class="moreinformation">
                            @if($activity->userown)
                                <button assistID="{{$activity->id}}" class="assist btn btn-primary">Cancelar</button>
                            @elseif($activity->going)
                                <button assistID="{{$activity->id}}" class="assist btn btn-primary">No Asistiré</button>
                            @else
                                <button assistID="{{$activity->id}}" class="assist btn btn-danger">Asistiré</button>
                            @endif
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
