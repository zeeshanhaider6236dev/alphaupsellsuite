<?php namespace App\Jobs;
use App\User;
use App\Http\Traits\ShopifyTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;

class ThemeUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use ShopifyTrait;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain
     * @param stdClass $data    The webhook data (JSON decoded)
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $new_theme_id = json_encode($this->data->id);
        $this->user = User::with('settings')->where('name', $this->shopDomain)->whereNotNull('password')->first();
        $current_theme_id = $this->user->settings->themeId;
        if($new_theme_id != $current_theme_id):
            $this->user->settings()->update([
                'themeId'=>$new_theme_id,
                
            ]);
            $this->createSnippetFile($new_theme_id,$this->user);   
            $this->includeSnippet($new_theme_id,$this->user);   
        endif; 
                  
            
       
    }
}
