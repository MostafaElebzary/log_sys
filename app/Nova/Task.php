<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Task extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Task::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'task';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'task',
        'start_date',
        'end_date',
        'note',
        'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Status::make('Status', 'status')
                ->loadingWhen(['in_progress'])
                ->failedWhen(['not_started'])->sortable(),
            BelongsTo::make('Category', 'Category', Category::class)->rules('required'),
            BelongsTo::make('User', 'User', User::class)->rules('required'),
            Trix::make('task', 'task')->rules('required'),
            Text::make('task', 'task')
                ->asHtml()->onlyOnIndex(),
            Trix::make('note', 'note')->rules('required'),
            Date::make('start_date')->sortable()->rules('required'),
            Date::make('end_date')->sortable()->rules('required'),
            Image::make('image', 'image'),
            Select::make('Status','status')->options([
                'not_started' => 'not started',
                'in_progress' => 'in progress',
                'done' => 'Finished',
            ])->hideFromIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
