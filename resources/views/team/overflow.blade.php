@extends('layouts.app3')

@section('template_title')
    Team Overflow
@endsection

@section('inhead')
    <link rel="stylesheet" href="/public/css/overflow.css">
    <style>
        .columnOverflow {
            float: left;
            padding-left: 30px;
            padding-right: 30px;
        }

        .containerC {
            margin: auto;
            display: table;
        }
    </style>
@endsection

@section('content')
    <div class="containerC">
        <div class="columnOverflow">
            <div class="userInfo">
                <div class="userInfoElement"></div>
                <div class="userInfoBanner">
                    <img src="/public/images/banner.png"/>
                </div>
                <div class="userInfoAvatar">
                    <img src="/public/images/testav.png"/>
                </div>
                <span class="userInfoName">{{ \Illuminate\Support\Facades\Auth::user()["name"] }}</span>
                <span class="userInfoTeam">team: Nanosoft</span>
            </div>

            <div class="usersTasks">
                <div class="usersTasksBG"></div>
                <div class="usersTasksBGContent">
                    <span class="usersTasksTitle">Your personal tasks for today</span>
                    <div class="usersTasksContent">
                        <ul style="position: relative">
                            @foreach($userTasks as $task)
                                <li class="teamTasksTask">
                                    <div class="usersTasksForEachTask">
                                        <div class="usersTasksifDone"></div>
                                        <span class="usersTasksTaskTitle">{{ $task["name"] }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="columnOverflow">
            <div class="postEdit">
                <div class="postEditBG"></div>
                <div class="postEditContainer">
                    <div class="postEditField">
                        <form action="overflow.blade.php" method="POST"></form>
                            <input id="postContentNONHASH" type="text" class="postEditText ctrl1" placeholder="I have an idea...">
                            <input type="hidden" id="control" value="DONE"/>
                            <input type="submit" class="postEditSendButton ctrl1" value="Go for it!">
                        </form>
                    </div>
                </div>
            </div>

            <div class="posts" style="margin-top: 30px;">
                <div class="postsBG"></div>
                <div class="postsCanvas">
                    <div class="postsPostCanvaBG"></div>
                    <div class="postsAvatar">
                        <img src="{{ asset('/images/testav.png') }}">
                    </div>
                </div>
                <span class="postsPostContent">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac est justo. Aenean facilisis magna quam, sed sollicitudin dolor volutpat vitae. Pellentesque euismod quis elit vitae interdum. Donec et tellus odio.</span>
            </div>
        </div>
        <div class="columnOverflow">
            <div class="teamTasks">
                <div class="teamTasksBG"></div>
                <div class="teamTasksContainer">
                    <span class="teamTasksTitle">Your team tasks for today</span>
                    <ul class="teamTasksUL">
                        <li class="teamTasksTask">
                            <div class="teamTasksTContainer">
                                <div class="teamTasksTBG"></div>
                                <div class="teamTasksIfDone"></div>
                                <span class="teamTasksTaskContent">Lorem Ipsum dolor sit amet</span>
                            </div>
                        </li>
                        <li class="teamTasksTask">
                            <div class="teamTasksTContainer">
                                <div class="teamTasksTBG"></div>
                                <div class="teamTasksIfDone"></div>
                                <span class="teamTasksTaskContent">Lorem Ipsum dolor sit amet</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
