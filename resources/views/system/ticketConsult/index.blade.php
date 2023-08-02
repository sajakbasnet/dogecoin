@extends('system.layouts.details')
@section('card-layout')
<div class="mt-5">
    <div class="row">
        <!-- First Column -->
        <div class="col-md-8">
            <div class="row">
                <!-- Small Cards -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">



                            <div class="d-flex align-items-center">
                                <div class="avatar lg  rounded-1 no-thumbnail bg-lightyellow color-defult">
                                    <img src="{{asset('images/optic.svg')}}">
                                </div>
                                <div class="flex-fill ms-4 text-truncate">
                                    <div class="text-truncate">Status</div>
                                    <span class="badge bg-warning">{{strtoupper(str_replace('-',' ',$items->status)) ?? ''}}</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar lg  rounded-1 no-thumbnail bg-lightblue color-defult"><img src="{{asset('images/user.svg')}}"></div>
                                <div class="flex-fill ms-4 text-truncate">
                                    <div class="text-truncate">Created Name</div>
                                    <span class="fw-bold">{{strtoupper($items->user->name) ?? ''}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar lg  rounded-1 no-thumbnail bg-lightgreen color-defult"><img src="{{asset('images/price.svg')}}"></div>
                                <div class="flex-fill ms-4 text-truncate">
                                    <div class="text-truncate">Priority</div>
                                    <span class="badge bg-danger">High</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Description Card -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 text-danger">{{strtoupper($items->subject) ?? ''}}</h6>
                            <p>{{$items->description ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Column (Leave empty if you don't need any content here) -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body card-body-height py-4">
                    <div class="row">
                        @include('system.partials.message')
                        <div class="col-lg-12 col-md-12">
                            <h6 class="mb-0 fw-bold mb-3">Ticket Message</h6>
                            <form method="POST" action="{{ route('consult.store', $items->id) }}">
                                @csrf
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="post">
                                            <textarea class="form-control" placeholder="Post" rows="4" name="message" required></textarea>
                                            <div class="py-3">
                                                <!-- <a href="#" class="px-3 " title="upload images"> <i class="fas fa-camera status-icon"></i></a>
                                                <a href="#" class="px-3 " title="upload video"><i class="fas fa-video"></i></a>
                                                <a href="#" class="px-3 " title="Send for signuture"><i class="fas fa-pen"></i></a> -->
                                                <button class="btn btn-primary float-sm-end  mt-2 mt-sm-0" type submit>Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- .Card End -->
                            <ul class="list-unstyled res-set">
                                <li class="card mb-2">
                                    <div class="card-body">
                                        <!-- <div class="d-flex mb-3 pb-3 border-bottom">
                                            <img class="avatar rounded-circle" src="assets/images/xs/avatar1.jpg" alt="">
                                            <div class="flex-fill ms-3 text-truncate">
                                                <h6 class="mb-0"><span>Nellie Maxwell</span> <span class="text-muted small">posted a status</span></h6>
                                                <span class="text-muted">3 hours ago</span>
                                            </div>
                                        </div> -->

                                        <!-- <h6>Internet Not Working for Last 2 Days</h6>
                                            <p>On the other hand, if the Internet doesn't work on other devices too, then the problem is most likely with the router or the Internet connection itself</p>
                                           -->
                                        <div class="mb-2 mt-4">
                                            <a class="me-lg-4 me-2 text-primary" href="#"><i class="fas fa-comment"></i> Comment ({{count($messages)}})</a>
                                        </div>

                                        @foreach($messages as $message)
                                        <div class="d-flex mt-3 pt-3 border-top">                                           
                                            <img class="avatar rounded-circle"  src="{{asset('images/user.svg')}}" style="background-color: white;">
                                            <div class="flex-fill ms-3 text-truncate">
                                                <p class="mb-0"><span>{{$message->users->name ?? ''}}</span> <small class="msg-time"> {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</small></p>
                                                <span class="text-muted">{{$message->message ?? ''}}</span>
                                            </div>
                                        </div>
                                        @endforeach


                                        <!-- <div class="mt-4">
                                            <textarea class="form-control" placeholder="Replay"></textarea>
                                        </div> -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection