@extends('layouts.app', ['activePage' => 'Organisation profile', 'titlePage' => __('Resource Request')])

@section('content')
<?php
$in_cards = false;
?>

<div class="content">
    <div id="resume">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Project Details</h4>
                </div>
                <div class="card-body ">
                    <p>Project Name : {{$project->project_name}}</p>
                    <p>Project Description : {{$project->description}}</p>
                    <br>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Project Timeline</h4>
                </div>
                <div class="card-body ">
                    <div class="timeline">
                        @foreach($timeline as $event)
                        @switch($event->type)
                        @case(constant('App\Models\Timeline::STAGE_TYPE'))
                        @if($in_cards)
                    </div>
                    @php
                    $in_cards = false;
                    @endphp
                    @endif
                    <div class="stage" aria-hidden="true">
                        <header class="t_card__header">
                            <time class="stage__date time">
                                {{$event->stage->created_at->format("d-m-Y")}}
                            </time>
                            <h4 class="t_card__title r-title">Project assigned
                                {{$stages->firstWhere('id', $event->stage->project_stage_id)->project_stage}}</h4>
                        </header>
                        <div class="t_card__content">
                            <p>{{$event->stage->stage_description}}</p>

                        </div>
                        @break

                        @case(constant('App\Models\Timeline::GRADUATION_TYPE'))
                        @if($in_cards)
                    </div>
                    @php
                    $in_cards = false;
                    @endphp
                    @endif
                    <div class="timeline__card t_card call graduate" aria-hidden="true">
                        <header class="t_card__header">
                            <time class="time">
                                {{$event->graduation->graduation_date->format("d-m-Y")}}
                            </time>
                        </header>
                        <div class="t_card__content">
                            <p>{{$event->graduation->progress_summary}}</p>
                        </div>

                    </div>
                    @break

                    @case(constant('App\Models\Timeline::CALL_TYPE'))
                    @if(!$in_cards)
                    <div class="timeline__cards">
                        @php
                        $in_cards = true;
                        @endphp
                        @endif
                        <div class="timeline__card t_card call">
                            <header class="t_card__header">
                                <time class="time">
                                    {{$event->top_date->format("d-m-Y")}}
                                </time>
                                <h4 class="t_card__title r-title">
                                    {{$calls->firstWhere('id', $event->callSignUps[0]->call_id)->title}}</h4>
                            </header>
                            <div class="t_card__content">
                                <p>{{Str::limit($calls->firstWhere('id', $event->callSignUps[0]->call_id)->description, 600)}}
                                </p>

                                @foreach($event->callSignUps as $signUp)
                                <div class="accordion" id="accordion_{{$signUp->id}}">
                                    <div class="card">
                                        <div class="card-header" id="heading_{{$signUp->id}}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button"
                                                    data-toggle="collapse" data-target="#collapse_{{$signUp->id}}"
                                                    aria-expanded="true" aria-controls="collapse_{{$signUp->id}}">
                                                    Sign up report:
                                                    {{$users->firstWhere('id', $signUp->user_id)->name.' '.$users->firstWhere('id', $signUp->user_id)->surname}}
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse_{{$signUp->id}}" class="collapse"
                                            aria-labelledby="heading_{{$signUp->id}}"
                                            data-parent="accordion_{{$signUp->id}}">
                                            <div class="card-body">
                                                {{$signUp->callSignUpReport->report}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @break

                        @case(constant('App\Models\Timeline::TASK_TYPE'))
                        @if(!$in_cards)
                        <div class="timeline__cards">
                            @php
                            $in_cards = true;
                            @endphp
                            @endif
                            <div class="timeline__card t_card task">
                                <header class="t_card__header">
                                    <time class="time">
                                        {{$event->top_date->format("d-m-Y")}}
                                    </time>
                                    <h4 class="t_card__title r-title">Resource Request: {{$event->task->title}}</h4>
                                </header>
                                <div class="t_card__content">
                                    <p>{{Str::limit($event->task->description,600)}}</p>

                                    @foreach($event->task->taskReply as $reply)
                                   <div class="accordion" id="accordion_{{$reply->id}}">
                                    <div class="card">
                                        <div class="card-header" id="heading_{{$reply->id}}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button"
                                                    data-toggle="collapse" data-target="#collapse_{{$reply->id}}"
                                                    aria-expanded="true" aria-controls="collapse_{{$reply->id}}">
                                                    Reply from: 
                                                    @php
                                                    $user = $users->firstWhere('id', $reply->user_id);
                                                    echo $user->title.' '.$user->name.' '.$user->surname;
                                                    @endphp
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse_{{$reply->id}}" class="collapse"
                                            aria-labelledby="heading_{{$reply->id}}"
                                            data-parent="accordion_{{$reply->id}}">
                                            <div class="card-body">
                                                {{$reply->relpy}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                </div>
                            </div>
                            @break
                            @endswitch
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /*
=====
DEPENDENCES
=====
*/

    .r-title {
        margin-top: var(--rTitleMarginTop, 0) !important;
        margin-bottom: var(--rTitleMarginBottom, 0) !important;
    }


    p:not([class]) {
        line-height: var(--cssTypographyLineHeight, 1.78);
        margin-top: var(--cssTypographyBasicMargin, 1em);
        margin-bottom: 0;
    }

    p:not([class]):first-child {
        margin-top: 0;
    }

    /*
text component
*/

    .text {
        display: var(--textDisplay, inline-flex);
        font-size: var(--textFontSize, 1rem);
    }

    /*
time component
*/

    /*
core styles
*/

    .time {
        display: var(--timeDisplay, inline-flex);
    }

    /*
extensions
*/

    .time__month {
        margin-left: var(--timelineMounthMarginLeft, .25em);
    }

    /*
skin
*/

    .time {
        padding: var(--timePadding, .25rem 1.25rem .25rem);
        background-color: var(--timeBackgroundColor, #f0f0f0);

        font-size: var(--timeFontSize, .75rem);
        font-weight: var(--timeFontWeight, 700);
        text-transform: var(--timeTextTransform, uppercase);
        color: var(--timeColor, currentColor);
    }

    /*
card component
*/

    /*
core styles
*/

    .t_card {
        padding: var(--timelineCardPadding, 1.5rem 1.5rem 1.25rem);
    }

    .t_card__content {
        margin-top: var(--cardContentMarginTop, .5rem);
    }

    /*
skin
*/

    .t_card {
        border-radius: var(--timelineCardBorderRadius, 2px);
        border-left: var(--timelineCardBorderLeftWidth, 3px) solid var(--timelineCardBorderLeftColor, var(--uiTimelineMainColor));
        box-shadow: var(--timelineCardBoxShadow, 0 1px 3px 0 rgba(0, 0, 0, .12), 0 1px 2px 0 rgba(0, 0, 0, .24));
        background-color: var(--timelineCardBackgroundColor, #fff);
    }

    .stage {
        --timeFontWeight: var(--timelineYearFontWeight, 400);
        --timePadding: var(--timelineYearPadding, .5rem 1.5rem);
        --timeColor: var(--uiTimelineSecondaryColor);
        padding: var(--timelineCardPadding, 1.5rem 1.5rem 1.25rem);
        margin-bottom: 1.25rem;

        background-color: var(--timelineMainColor, #fff);

        font-size: var(--timeFontSize, .75rem);
        font-weight: var(--timeFontWeight, 700);
        color: var(--timeColor, currentColor);

        /* 1 */
    }

    /*
extensions
*/

    .t_card__title {
        --rTitleMarginTop: var(--cardTitleMarginTop, 1rem);
        font-size: var(--cardTitleFontSize, 1.25rem);
    }

    /*
=====
CORE STYLES
=====
*/

    .timeline {
        display: var(--timelineDisplay, grid);
        grid-row-gap: var(--timelineGroupsGap, 2rem);
    }

    /*
1. If timeline__year isn't displaed the gap between it and timeline__cards isn't displayed too
*/

    .timeline__cards {
        display: var(--timeloneCardsDisplay, grid);
        grid-row-gap: var(--timeloneCardsGap, 1.5rem);
    }

    .stage__date {
        /* padding: var(--timePadding, .25rem 1.25rem .25rem); */
        --timePadding: var(--timelineYearPadding, 0rem 0rem);
        --timeColor: var(--uiTimelineSecondaryColor);
        --timeBackgroundColor: var(--uiTimelineMainColor);
        --timeFontWeight: var(--timelineYearFontWeight, 400);
    }


    /*
=====
SKIN
=====
*/

    .timeline {
        --uiTimelineMainColor: var(--timelineMainColor, #222);
        --uiTimelineSecondaryColor: var(--timelineSecondaryColor, #fff);

        border-left: var(--timelineLineWidth, 3px) solid var(--timelineLineBackgroundColor, var(--uiTimelineMainColor));
        padding-top: 1rem;
        padding-bottom: 1.5rem;
    }

    .timeline__card {
        position: relative;
        margin-left: var(--timelineCardLineGap, 1rem);
    }

    /*
1. Stoping cut box shadow
*/

    .timeline__cards {
        overflow: hidden;
        padding-top: .25rem;
        /* 1 */
        padding-bottom: .25rem;
        /* 1 */
    }

    .timeline__card::before {
        content: "";
        width: 100%;
        height: var(--timelineCardLineWidth, 2px);
        background-color: var(--timelineCardLineBackgroundColor, var(--uiTimelineMainColor));

        position: absolute;
        top: var(--timelineCardLineTop, 1rem);
        left: -50%;
        z-index: -1;
    }

    /*
=====
SETTINGS
=====
*/
    /**/
    .timeline {
        --timelineMainColor: #1e73be;
    }

    .call {
        --uiTimelineMainColor: #00FF00;
    }

    .task {
        --uiTimelineMainColor: #FFA500;
    }

    .graduate {
        --uiTimelineMainColor: #1e73be;
    }

    /*
=====
DEMO
=====
*/

    .timeline__body {
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Open Sans, Ubuntu, Fira Sans, Helvetica Neue, sans-serif;
        color: #222;

        background-color: #f0f0f0;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    p:last-child {
        margin-bottom: 0;
    }

    .timeline__page {
        max-width: 47rem;
        padding: 5rem 2rem 3rem;
        margin-left: auto;
        margin-right: auto;
    }


    .substack {
        border: 1px solid #EEE;
        background-color: #fff;
        width: 100%;
        max-width: 480px;
        height: 280px;
        margin: 1rem auto;
        ;
    }


    .r-link {
        --uirLinkDisplay: var(--rLinkDisplay, inline-flex);
        --uirLinkTextColor: var(--rLinkTextColor);
        --uirLinkTextDecoration: var(--rLinkTextDecoration, none);

        display: var(--uirLinkDisplay) !important;
        color: var(--uirLinkTextColor) !important;
        text-decoration: var(--uirLinkTextDecoration) !important;
    }
    </style>

    @endsection