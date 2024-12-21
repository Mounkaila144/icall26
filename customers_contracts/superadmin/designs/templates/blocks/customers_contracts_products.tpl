{foreach $contract->getActiveProducts() as $product}
{$product->get('meta_title')}{if !$product@last},{/if}
{/foreach}
