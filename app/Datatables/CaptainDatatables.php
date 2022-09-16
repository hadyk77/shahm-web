<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\User;
use App\Support\DataTableActions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CaptainDatatables implements DatatableInterface
{

    public static function columns(): array
    {
        return [
            "profile_image",
            "name",
            "phone",
            "email",
            "captain_wallet",
            "status",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("created_at", function (User $user) {
                return Helper::formatDate($user->created_at);
            })
            ->addColumn("profile_image", function (User $user) {
                return DataTableActions::image($user->profile_image);
            })
            ->addColumn("updated_at", function (User $user) {
                return Helper::formatDate($user->updated_at);
            })
            ->addColumn("status", function (User $user) {
                return (new DataTableActions())
                    ->model($user)
                    ->modelId($user->id)
                    ->column("captain_status")
                    ->checkStatus($user->captain_status)
                    ->switcher();
            })
            ->addColumn("action", function (User $user) {
                $buttons = '<a data-bs-toggle="modal" data-bs-target="#send_message" href="javascript:;" data-url="' .  route('admin.message.send', $user->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
												<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
											</svg>
										</span>
									</a>';
                $buttons .= '<a data-bs-toggle="modal" data-bs-target="#add_money_to_captain" href="javascript:;" data-url="' .  route('admin.add.transaction', $user->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                                            </svg>
										</span>
									</a>';
                return (new DataTableActions())
                    ->show(route("admin.captain.show", [$user->id, 'type' => "overview"]))
                    ->button($buttons)
                    ->edit(route("admin.captain.edit", $user->captain->id))
                    ->delete(route("admin.captain.destroy", $user->captain->id))
                    ->make();
            })
            ->rawColumns(["action", "status", "profile_image"])
            ->make();
    }

    public function query(Request $request)
    {
        return User::query()
            ->where("is_captain", true)
            ->when($request->filled("status") && $request->status == "inactive", function ($query) use ($request) {
                return $query->where("captain_status", 0);
            })
            ->when($request->filled("status") && $request->status == "active", function ($query) use ($request) {
                return $query->where("captain_status", 1);
            })
            ->select("*");
    }
}
