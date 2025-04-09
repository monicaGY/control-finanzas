<?php

namespace Spent\Domain\Model;

interface SpentRepository
{
    public function delete(int $id);
    public function update(int $id, array $spent);
    public function add($spent);

}
