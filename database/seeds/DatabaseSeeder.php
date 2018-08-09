<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(TeamSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(ContactCompanySeed::class);
        $this->call(AdSeed::class);
        $this->call(CategorySeed::class);
        $this->call(AgentSeed::class);
        $this->call(ContactSeed::class);
        $this->call(PhoneSeed::class);
        $this->call(CategorySeedPivot::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);

    }
}
