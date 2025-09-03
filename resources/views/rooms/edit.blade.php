@extends('layouts.app')

@section('content')
<div class="container py-5">    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="background-color: #fffbe9;">
                <div class="card-header text-center" style="background-color: #e6d3b3;">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">Edit Room</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rooms.update', $room->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name_room" class="form-label" style="color: #7c5e3c;">Room Name</label>
                            <input type="text" class="form-control form-control-custom" id="name_room" name="name_room" value="{{ old('name_room', $room->name_room) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label" style="color: #7c5e3c;">Price</label>
                            <input type="number" class="form-control form-control-custom" id="price" name="price" value="{{ old('price', $room->price) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label" style="color: #7c5e3c;">Capacity</label>
                            <input type="number" class="form-control form-control-custom" id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label" style="color: #7c5e3c;">Status</label>
                            <select class="form-select form-control-custom" id="status" name="status" required>
                                <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ old('status', $room->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                <option value="booked" {{ old('status', $room->status) == 'booked' ? 'selected' : '' }}>Booked</option>
                            </select>   
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label" style="color: #7c5e3c;">Description</label>
                            <textarea class="form-control form-control-custom" id="description" name="description" rows="3">{{ old('description', $room->description) }}</textarea> 
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('rooms.index') }}" class="btn btn-custom-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-custom-primary">Update Room</button>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection