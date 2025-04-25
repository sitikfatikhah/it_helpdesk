{{-- resources/views/filament/pages/report.blade.php --}}

<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $form }}

        <div class="mt-4">
            <x-filament::button type="submit">Filter</x-filament::button>
        </div>
    </form>

    <hr class="my-6">

    <h2 class="text-lg font-bold mb-2">Filtered Tickets</h2>

    <table class="min-w-full bg-white text-sm">
        <thead>
            <tr>
                <th class="px-2 py-1">Ticket #</th>
                <th>User</th>
                <th>Dept</th>
                <th>Date</th>
                <th>Category</th>
                <th>Priority</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td class="border px-2 py-1">{{ $ticket->ticket_number }}</td>
                    <td class="border px-2 py-1">{{ $ticket->user_id }}</td>
                    <td class="border px-2 py-1">{{ $ticket->department_id }}</td>
                    <td class="border px-2 py-1">{{ $ticket->date }}</td>
                    <td class="border px-2 py-1">{{ $ticket->category }}</td>
                    <td class="border px-2 py-1">{{ $ticket->priority_level }}</td>
                    <td class="border px-2 py-1">{{ $ticket->ticket_status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-3">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-filament::page>

