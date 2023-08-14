<?php declare(strict_types=1);

namespace zomarrd\forms;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use zomarrd\forms\entries\simple\Button;

abstract class PaginatedForm extends SimpleForm
{

    protected int $current_page;

    public function __construct(string $title, ?string $content = null, int $current_page = 1)
    {
        parent::__construct($title, $content);
        $this->current_page = $current_page;

        $this->populatePage();
        $pages = $this->getPages();
        if ($this->current_page === 1) {
            if ($pages > 1) {
                $this->addButton($this->getNextButton(), function (Player $player, int $data): void {
                    $this->sendNextPage($player);
                });
            }
        } else {
            $this->addButton($this->getPreviousButton(), function (Player $player, int $data): void {
                $this->sendPreviousPage($player);
            });
            if ($this->current_page < $pages) {
                $this->addButton($this->getNextButton(), function (Player $player, int $data): void {
                    $this->sendNextPage($player);
                });
            }
        }
    }

    abstract protected function populatePage(): void;

    abstract protected function getPages(): int;

    protected function getNextButton(): Button
    {
        return new Button(TF::BOLD . TF::BLACK . "Next Page" . TF::RESET . TF::EOL . TF::DARK_GRAY . "Turn to the next page");
    }

    abstract protected function sendNextPage(Player $player): void;

    protected function getPreviousButton(): Button
    {
        return new Button(TF::BOLD . TF::BLACK . "Previous Page" . TF::RESET . TF::EOL . TF::DARK_GRAY . "Turn to the previous page");
    }

    abstract protected function sendPreviousPage(Player $player): void;
}
