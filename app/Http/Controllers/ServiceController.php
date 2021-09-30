<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Flash;
use App\Http\Controllers\AppBaseController;
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
