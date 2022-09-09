<?php

namespace App\Services\Notification;

use App\Services\ServiceInterface;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class NotificationServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Auth::user()->notifications()->get();
    }

    public function getNotificationForCaptains(): array|Collection
    {
        return Auth::user()->notifications()->where("for_captain", 1)->get();
    }

    public function getNotificationForClients(): array|Collection
    {
        return Auth::user()->notifications()->where("for_captain", 0)->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Auth::user()->notifications()->findOrFail($id);
    }

    public function findNotificationForCaptainById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Auth::user()->notifications()->where("for_captain", 1)->findOrFail($id);
    }

    public function findNotificationForClientById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Auth::user()->notifications()->where("for_captain", 0)->findOrFail($id);
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $notification = $this->findById($id);

            $notification->delete();

        });
    }
}
