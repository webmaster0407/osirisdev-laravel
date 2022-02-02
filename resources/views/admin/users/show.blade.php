@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.photo') }}
                        </th>
                        <td>
                            @if($user->photo)
                                <a href="{{ $user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <td>
                            {{ $user->firstname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.two_factor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.emailprivate') }}
                        </th>
                        <td>
                            {{ $user->emailprivate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.birthdate') }}
                        </th>
                        <td>
                            {{ $user->birthdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.city') }}
                        </th>
                        <td>
                            {{ $user->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.rkid') }}
                        </th>
                        <td>
                            {{ $user->rkid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.dghid') }}
                        </th>
                        <td>
                            {{ $user->dghid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.pagerid') }}
                        </th>
                        <td>
                            {{ $user->pagerid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.created_by') }}
                        </th>
                        <td>
                            {{ $user->created_by->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.competenceregistrations') }}
                        </th>
                        <td>
                            @foreach($user->competenceregistrations as $key => $competenceregistrations)
                                <span class="label label-info">{{ $competenceregistrations->startdate }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#userid_notes" role="tab" data-toggle="tab">
                {{ trans('cruds.note.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_competenceregistrations" role="tab" data-toggle="tab">
                {{ trans('cruds.competenceregistration.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_prevregistrations" role="tab" data-toggle="tab">
                {{ trans('cruds.prevregistration.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assigneduser_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_eventregistrations" role="tab" data-toggle="tab">
                {{ trans('cruds.eventregistration.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_comlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.comlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#users_incidents" role="tab" data-toggle="tab">
                {{ trans('cruds.incident.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="userid_notes">
            @includeIf('admin.users.relationships.useridNotes', ['notes' => $user->useridNotes])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_competenceregistrations">
            @includeIf('admin.users.relationships.userCompetenceregistrations', ['competenceregistrations' => $user->userCompetenceregistrations])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_prevregistrations">
            @includeIf('admin.users.relationships.userPrevregistrations', ['prevregistrations' => $user->userPrevregistrations])
        </div>
        <div class="tab-pane" role="tabpanel" id="assigneduser_tasks">
            @includeIf('admin.users.relationships.assigneduserTasks', ['tasks' => $user->assigneduserTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_eventregistrations">
            @includeIf('admin.users.relationships.userEventregistrations', ['eventregistrations' => $user->userEventregistrations])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_comlogs">
            @includeIf('admin.users.relationships.userComlogs', ['comlogs' => $user->userComlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="users_incidents">
            @includeIf('admin.users.relationships.usersIncidents', ['incidents' => $user->usersIncidents])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>

@endsection