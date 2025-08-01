<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class Home extends Component implements HasForms
{
    use InteractsWithForms;

    public $user_id ='';
    public $department ='';
    public $ticket_number ='';
    public $date ='';
    public $open_time ='';
    public $priority_level ='';
    public $category ='';
    public $description ='';
    public $type_device ='';
    public $operation_system ='';
    public $software_or_application ='';
    public $error_message ='';
    public $step_taken ='';
    public $ticket_status ='';


    public function form(Form $form): Form
    {
        return $form->schema([
           Forms\Components\Select::make('user_id')
                ->label('User')
                ->default(Auth::id())
                ->relationship('user', 'name')
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('department_id', \App\Models\User::find($state)?->department_id)
                )
                ->disabled(fn () => !auth()->user()->hasRole('superadmin')) // ❌ selain superadmin: tidak bisa ubah
                ->dehydrated(true)
                ->required(),

            Forms\Components\Select::make('department_id')
                ->default(Auth::user()->department_id)
                ->label('Department')
                ->options(fn () => Department::all()>pluck('name')->toArray())
                ->disabled()
                ->dehydrated(true)
                ->required(),

            Forms\Components\TextInput::make('ticket_number')
                ->label('Ticket Number')
                ->default(function () {
                    $yearSuffix = now()->format('y');
                    $countThisYear = Ticket::whereYear('created_at', now()->year)->count();
                    return 'TC-' . $yearSuffix . str_pad($countThisYear + 1, 3, '0', STR_PAD_LEFT);
                })
                ->disabled()
                ->dehydrated(false)
                ->required(),

            Forms\Components\DatePicker::make('date')
                ->default(today())
                ->required(),

            Forms\Components\TimePicker::make('open_time')
                ->default(now()->format('H:i'))
                ->displayFormat('H:i')
                ->reactive()
                ->required(),

            Forms\Components\ToggleButtons::make('category')
                ->options([
                    'software' => 'Software',
                    'hardware' => 'Hardware',
                    'network' => 'Network',
                    'other' => 'Other',
                ])
                ->grouped()
                ->required(),

            Forms\Components\ToggleButtons::make('type_device')
                ->label('Device Type')
                ->options([
                    'desktop' => 'Desktop',
                    'laptop' => 'Laptop',
                    'printer' => 'Printer',
                    'other' => 'Other',
                ])
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->grouped()
                ->nullable(),

            Forms\Components\ToggleButtons::make('operation_system')
                ->options([
                    'windows' => 'Windows',
                    'macos' => 'MacOS',
                    'linux' => 'Linux',
                    'other' => 'Other',
                ])
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->grouped()
                ->nullable(),

            Forms\Components\TextInput::make('software_or_application')
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->default('-')
                ->dehydrated(true),

            Forms\Components\TextInput::make('error_message')
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->nullable(),

            Forms\Components\Textarea::make('description')
                ->columnSpanFull()
                ->required(),

            Forms\Components\Textarea::make('step_taken')
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->columnSpanFull(),

            Forms\Components\ToggleButtons::make('priority_level')
                ->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ])
                ->default('low')
                ->grouped()
                ->nullable()
                ->disabled(fn () => !Auth::user()?->hasRole('superadmin')),

            Forms\Components\Select::make('ticket_status')
                ->label('Status')
                ->options([
                    'on_progress' => 'On Progress',
                    'solved' => 'Solved',
                    'callback' => 'Callback',
                    'monitored' => 'Monitored',
                    'other' => 'Other',
                ])
                ->default('on_progress')
                ->disabled(fn () => !Auth::user()?->hasRole('superadmin'))
                ->nullable(),
        ]);
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function save(): Void
    {
        dd($this->forms()->getState());
    }
}
