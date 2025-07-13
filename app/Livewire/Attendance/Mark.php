<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class Mark extends Component
{
    public $subjectId;
    public $subject;
    public $students = [];
    public $statuses = [];
    public $date;

    public function mount($subjectId, $date)
    {
        $this->subjectId = $subjectId;
        $this->date = $date;

        $this->subject = Subject::with('classroom.students')->findOrFail($subjectId);
        $this->students = $this->subject->classroom?->students ?? [];

        $this->loadAttendanceStatuses();
    }

    protected function loadAttendanceStatuses()
    {
        $this->statuses = Attendance::where('subject_id', $this->subject->id)
            ->where('date', $this->date)
            ->pluck('status', 'student_id')
            ->toArray();
    }

    public function save()
    {
        foreach ($this->students as $student) {
            if (empty($this->statuses[$student->id])) {
                $this->addError('statuses.' . $student->id, 'Please select status for all students.');
            }
        }

        if ($this->getErrorBag()->isNotEmpty()) {
            return;
        }

        foreach ($this->students as $student) {
            $status = $this->statuses[$student->id];

            Attendance::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'subject_id' => $this->subject->id,
                    'date'       => $this->date,
                ],
                [
                    'classroom_id' => $this->subject->classroom_id,
                    'status'       => $status,
                    'marked_by'    => Auth::id(),
                ]
            );
        }

        session()->flash('success', 'Attendance saved successfully.');
        return redirect()->route('attendance.index', ['date' => $this->date]);
    }

    public function render()
    {
        return view('livewire.attendance.mark');
    }
}
