<?php

namespace App\Filament\Resources\SeoSectionResource\Pages;

use App\Filament\Resources\SeoSectionResource;
use App\Filament\Resources\SeoSectionResource\SeoSectionManager;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditSeoSection extends EditRecord
{
    protected static string $resource = SeoSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        $manager = $this->getSeoSectionManager($this->record->key);

        return $manager->form($form);
    }

    public function getSeoSectionManager(string $key): SeoSectionResource\SeoSectionManager\SeoSectionManager
    {
        $managerClass = match ($key) {
            'banner' => SeoSectionManager\BannerManager::class,
            'cases' => SeoSectionManager\CasesManager::class,
            'issues' => SeoSectionManager\IssuesManager::class,
            'plans' => SeoSectionManager\PlansManager::class,
        };

        return new $managerClass();
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
        $manager = $this->getSeoSectionManager($this->record->key);

        return $manager->mutateFormDataBeforeSave($this->record, $data);
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('edit', ['record' => $this->record->getKey()]));
    }
}
