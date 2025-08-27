<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $models = [
            // Base
            'Country', 'City', 'Address',

            // Roles
            'Role', 'RoleUser',

            // Hotels
            'Hotel', 'HotelPhoto', 'Amenity', 'AmenityHotel',

            // Rooms
            'RoomType', 'Room', 'RoomPhoto',

            // Rates & Coupons
            'RatePlan', 'RateOverride', 'Coupon',

            // Reservations
            'Reservation', 'ReservationItem', 'RoomCalendar',

            // Payments & Reviews
            'Payment', 'Review'
        ];

        foreach ($models as $model) {
            $this->createRepository($model);
        }

        $this->info("✅ All repositories generated successfully!");
    }

    private function createRepository(string $name)
    {
        $interfaceName = "{$name}RepositoryInterface";
        $className = "{$name}Repository";

        $contractPath = app_path("Repositories/Contracts/{$interfaceName}.php");
        $classPath = app_path("Repositories/Eloquent/{$className}.php");

        // 🗂 إنشاء المجلدات
        if (!File::exists(app_path('Repositories/Contracts'))) {
            File::makeDirectory(app_path('Repositories/Contracts'), 0755, true);
        }
        if (!File::exists(app_path('Repositories/Eloquent'))) {
            File::makeDirectory(app_path('Repositories/Eloquent'), 0755, true);
        }

        // ✍️ Contract
        $contractContent = <<<PHP
        <?php

        namespace App\Repositories\Contracts;

        interface {$interfaceName}
        {
            public function all();
            public function find(int \$id);
            public function withRelations();
            public function withJoinExample();
        }
        PHP;

        // ✍️ Implementation
        $classContent = <<<PHP
        <?php

        namespace App\Repositories\Eloquent;

        use App\Repositories\Contracts\\{$interfaceName};
        use App\Models\\{$name};

        class {$className} implements {$interfaceName}
        {
            public function all()
            {
                return {$name}::all();
            }

            public function find(int \$id)
            {
                return {$name}::find(\$id);
            }

            public function withRelations()
            {
                return {$name}::with([])->get();
            }

            public function withJoinExample()
            {
                return {$name}::query()
                    ->leftJoin('reservations', 'reservations.{$name}_id', '=', strtolower('{$name}') . 's.id')
                    ->select(strtolower('{$name}') . 's.*')
                    ->selectRaw('COUNT(reservations.id) as reservations_count')
                    ->groupBy(strtolower('{$name}') . 's.id')
                    ->get();
            }
        }
        PHP;

        // 📝 كتابة الملفات
        File::put($contractPath, $contractContent);
        File::put($classPath, $classContent);

        $this->info("📂 Created Repository: {$interfaceName}, {$className}");
    }
}
