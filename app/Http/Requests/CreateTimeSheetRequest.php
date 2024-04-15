<?php

namespace App\Http\Requests;

use App\Models\ProjectUser;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTimeSheetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_user_id' => [
                'required', 'numeric',
                Rule::exists('project_users', 'id')->where(function (Builder $query) {
                    return $query->where('user_id', auth('user')->id());
                }),
            ],
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i', 'before:end_time'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'summary_of_work' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'project_user_id.required' => 'Project is required',
            'project_user_id.numeric' => 'Project must be a number',
            'project_user_id.exists' => 'Project does not exist',
            'date.required' => 'Date is required',
            'date.date' => 'Date must be a valid date',
            'start_time.required' => 'Start time is required',
            'start_time.date_format' => 'Start time must be a valid time',
            'start_time.before' => 'Start time must be before end time',
            'end_time.required' => 'End time is required',
            'end_time.date_format' => 'End time must be a valid time',
            'end_time.after' => 'End time must be after start time',
            'summary_of_work.required' => 'Summary of work is required',
            'summary_of_work.string' => 'Summary of work must be a string',
            'summary_of_work.max' => 'Summary of work must not exceed 255 characters',
        ];
    }
}
