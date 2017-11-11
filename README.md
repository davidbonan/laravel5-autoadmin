# laravel5-autoadmin
Laravel 5.5 instance with class for generate panel admin with JSON

# Get started
For use this plugin you may init 4 files and 1 optionals files :

Obligatory
- database/migrations/XXXXXX_YOURTABLE.php : That file is classic migration Laravel
- config/auto-admin/your_routename.php : that file is the file use for generate automatically admin panel
- app/Http/Controllers/Back/Your_routenameController.php : that file is use for reference to access to your Model
- app/Models/YOURTABLE.php : that file contain your eloquent instance 

Optional
- app/Repositories/YOURTABLERepository.php : that file contain method for your eloquent instance
