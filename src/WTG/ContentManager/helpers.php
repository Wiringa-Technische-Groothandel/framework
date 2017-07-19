<?php

if (! function_exists('block')) {
    /**
     * Find a block by name.
     *
     * @param  string  $blockName
     * @return string
     */
    function block(string $blockName) {
        /** @var BlockRepository $repo */
        $repo = app()->make(\WTG\ContentManager\Repositories\BlockRepository::class);
        $block = $repo->findByName($blockName);

        if ($block === null) {
            return "Block '$blockName' not found";
        }

        return view('contentmanager::block', compact('block'));
    }
}