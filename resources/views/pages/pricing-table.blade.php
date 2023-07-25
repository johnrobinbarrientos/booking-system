@extends('../layout/' . $layout)

@section('subhead')
    <title>Pricing Table| Rowland Contractors | Pump Booking System</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h1 class="text-lg font-medium truncate mr-5">New Pricing Table</h1>
                </div>
                <div>
                    <form action="">
                        <div class="flex flex-col mt-8">
                            <label for="" class="mb-2">Pricing Group Name</label>
                            <input type="text">
                        </div>

                        <div class="mt-6">
                            <div class>
                                <h2 class="text-lg font-medium mt-4">Pricing per pump size</h2>
                                <div>
                                    <table class="table">
                                        <thead class="p-6">
                                            <tr class="text-center">
                                                <th></th>
                                                <th class="p-6">50/47</th>
                                                <th class="p-6">45</th>
                                                <th class="p-6">40/38</th>
                                                <th class="p-6">37</th>
                                                <th class="p-6">32/33</th>
                                                <th class="p-6">28</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="font-medium">Min Hire</td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">extra time</td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">per m3</td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                                <td>
                                                    <input type="text" class="w-3/4">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table w-1/4">
                                        <thead class="p-6">
                                            <tr class="text-center">
                                                <th></th>
                                                <th>Line Pump</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="font-medium">Min Hire</td>
                                                <td>
                                                    <input type="text" class="w-1/4">
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">Extra time</td>
                                                <td>
                                                    <input type="text" class="w-1/4">
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td class="font-medium">per m3</td>
                                                <td>
                                                    <input type="text" class="w-1/4">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex text-center mt-4 w-full space-x-8">
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> Additional Man per hour</label>
                                            <input type="text">
                                        </div>
                                        <div class="w-33 flex flex-col mr-4 ml-4 ">
                                            <label for=""> Overtime per hour</label>
                                            <input type="text">
                                        </div>
                                        <div class="w-1/4 flex flex-col">
                                            <label for=""> offiste cleean out</label>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


