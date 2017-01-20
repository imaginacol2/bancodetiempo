@extends('layouts.app')

@section('content')
    <div class="mainactivity">
        <div class="mainactivityimage">
        @if ($activity->hasimage)
            <img src="/assets/activities/{{$activity->id}}.jpg" />
        @else
            <img src="/assets/categories/{{$activity->category->category}}.jpg" />
        @endif
            <div class="mainactivitytitle">
                <h1>{{$activity->title}}</h1>
            </div>
        </div>


        <div class="mainactivitycontent">
            <div class="mainactivitydescription">
                <h2>Descripción</h2>
                {{$activity->description}}
                @if(count($usersassist))
                    <div class="inscribed">
                        <h2>Asistentes</h2>
                        @foreach($usersassist as $usera)
                            {{$usera->id}}
                            {{$usera->name}}
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="info">
                <div class="placedate">
                    <h2>Ubicación, fecha y hora</h2>
                    <div class="place">
                        {{$activity->place}}
                    </div>
                    <div class="date">
                        <div class="day">
                            <span>
                                {{$activity->time[0]}}
                            </span>
                            {{$activity->time[1]}}
                            <span>
                                de
                            </span>
                            <span class="mounth">
                                {{$activity->time[2]}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="organized">
                    <h2>Organizador</h2>
                    <div class="organizedcontent">
                        @if($userown->image)
                            <img class="img-circle" src="/assets/profiles/{{$userown->id}}.jpg" />
                        @else
                            <img class="img-circle" src="/assets/user.png" />
                        @endif
                        {{$userown->name}}
                    </div>
                </div>

                <div class="quantity">
                    <h2>Cupos Restantes</h2>

                    @if($activity->userlimit==0)
                        Ilimitados
                    @else

                        <div class="linecontainer">
                            <div class="linedraw"></div>
                            <div class="linedraw over" style="width: {{(1 - $activity->userleft/$activity->userlimit)*100}}%"></div>
                        </div>

                        <div class="lineinfo">
                            @if($activity->userleft==null)
                                0
                            @else
                                {{$activity->userleft}}
                            @endif

                            <span>
                                de
                            </span>
                            {{$activity->userlimit}}
                        </div>

                        @if($activity->userown)
                            <div class="action">
                                <button class="btn btn-danger assist" assistID="{{$activity->id}}">Cancelar</button>
                            </div>
                        @elseif($activity->going)
                            <div class="action">
                                <button assistID="{{$activity->id}}" class="assist btn btn-primary">No Asistiré</button>
                            </div>
                        @else

                            @if($activity->userleft==0 && $activity->userleft!=0)
                                <div class="without">
                                    Agotados
                                </div>
                            @elseif ($activity->status==1)
                                <div class="action">
                                    <button class="btn btn-danger assist" assistID="{{$activity->id}}">Asistiré</button>
                                </div>
                            @else
                                <div class="cancel">
                                    Actividad Cancelada
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
