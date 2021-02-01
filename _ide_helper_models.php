<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Note
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property array|null $content
 * @property string $color
 * @property int|null $project_id
 * @property int $finished
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note_Scheduler[] $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Query\Builder|Note onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Note withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Note withoutTrashed()
 */
	class Note extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Note_Scheduler
 *
 * @property int $id
 * @property int $user_id
 * @property int $note_id
 * @property \datetime|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Note $note
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler whereNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note_Scheduler whereUserId($value)
 */
	class Note_Scheduler extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Project
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUserId($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note_Scheduler[] $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

