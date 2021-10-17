<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Flash;
use App\Http\Controllers\AppBaseController;
use Auth;
use Illuminate\Http\Request;
use Response;

class ServiceController extends AppBaseController
{
    /**
     * Display a listing of the Service.
     *
     * @param ServiceDataTable $serviceDataTable
     * @return Response
     */
    public function index(ServiceDataTable $serviceDataTable)
    {
        return $serviceDataTable->render('services.index');
    }

    /**
     * Display a listing of the Service on the blog.
     *
     * @param Request $request
     * 
     * @return Response
     */
    public function blog_index(Request $request)
    {
        $services = Service::all();
        $latest_services = Service::orderBy('id', 'desc')->take(5)->get();
        return view('blog.services.index', compact('services', 'latest_services'));
    }

    /**
     * Show the form for creating a new Service.
     *
     * @return Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created Service in storage.
     *
     * @param CreateServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceRequest $request)
    {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        /** @var Service $service */
        $service = Service::create($input);

        Flash::success('Service saved successfully.');

        return redirect(route('services.index'));
    }

    /**
     * Display the specified Service.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Service $service */
        $service = Service::find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }

        return view('services.show')->with('service', $service);
    }

    /**
     * Display the specified Service.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function blog_show($id)
    {
        /** @var Service $post */
        $service = Service::find($id);

        $latest_services = Service::orderBy('id', 'desc')->take(5)->get();

        // get previous post
        $previous = Service::where('id', '<', $id)->max('id');

        // get next post
        $next = Service::where('id', '>', $id)->min('id');

        if ($previous == '') {
            $previous = $service;
        } else {
            $previous = Service::find($previous);
        }
        if ($next == '') {
            $next = $service;
        } else {
            $next = Service::find($next);
        }

        if (empty($post)) {
            Flash::error('Service not found');

            return redirect(route('blog.services.index'));
        }

        return view('blog.services.service', compact('service', 'previous', 'next', 'latest_services'));
    }


    /**
     * Show the form for editing the specified Service.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Service $service */
        $service = Service::find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }

        return view('services.edit')->with('service', $service);
    }

    /**
     * Update the specified Service in storage.
     *
     * @param  int              $id
     * @param UpdateServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceRequest $request)
    {
        /** @var Service $service */
        $service = Service::find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $service->fill($request->all());
        $service->save();

        Flash::success('Service updated successfully.');

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified Service from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Service $service */
        $service = Service::find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }

        $service->delete();

        Flash::success('Service deleted successfully.');

        return redirect(route('services.index'));
    }
}
