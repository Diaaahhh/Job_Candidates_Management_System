<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>Document</title>
</head>

<body>
    <div class="container">
      <div class="flex flex-col">
  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
          <thead>
            <tr>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">ID</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Email</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Phone</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Years of Experience</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Previous Experience</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Age</th>
              <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($candidates as $candidate)
           <tr>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
      {{ $candidate->id}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
      {{ $candidate->name}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
      {{ $candidate->email}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
      {{ $candidate->phone}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
      {{ $candidate->experience_years}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
       @if ($candidate->previous_experience)
            @foreach ($candidate->previous_experience as $company => $role)
                <div>{{ $company }}: {{ $role }}</div>
            @endforeach
        @else
            <span>No experience</span>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
      {{ $candidate->age}}
    </td>
    <div class="edit_btn">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-end">
    <a href="{{ route('edit', $candidate->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
        Edit
    </a>
    <a href="{{ route('delete', $candidate->id) }}"
    class="inline-block bg-red-600 text-white px-4 py-2 rounded-md 
           hover:bg-red-700 transition duration-200 
           focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
>
    Delete
</a>

</td>

  </div>
  </tr>
            @endforeach
  
</tbody>

        </table>
      </div>
    </div>
  </div>
</div>
    </div>
</body>

</html>