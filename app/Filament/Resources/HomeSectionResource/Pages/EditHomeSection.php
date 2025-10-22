<?php

namespace App\Filament\Resources\HomeSectionResource\Pages;

use App\Filament\Resources\HomeSectionResource;
use App\Filament\Resources\HomeSectionResource\HomeSectionManager;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditHomeSection extends EditRecord
{
    protected static string $resource = HomeSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        $manager = $this->getHomeSectionManager($this->record->key);

        return $manager->form($form);
    }

    public function getHomeSectionManager(string $key): HomeSectionResource\HomeSectionManager\HomeSectionManager
    {
        $managerClass = match ($key) {
            'banner' => HomeSectionManager\BannerManager::class,
            'media' => HomeSectionManager\MediaManager::class,
            'reviews' => HomeSectionManager\ReviewsManager::class,
            'cases' => HomeSectionManager\CasesManager::class,
            'tech_and_data' => HomeSectionManager\TechAndDataManager::class,
            'our_philosophy' => HomeSectionManager\OurPhilosophyManager::class,
            'seo' => HomeSectionManager\SeoManager::class,
        };

        return new $managerClass();
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
        $manager = $this->getHomeSectionManager($this->record->key);

        return $manager->mutateFormDataBeforeSave($this->record, $data);
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('edit', ['record' => $this->record->getKey()]));
    }
}
