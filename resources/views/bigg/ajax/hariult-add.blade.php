<div class="box px-4 py-4 mb-3 flex items-center zoom-in">
    <div class="w-10"><?=useg($id);?>.</div>
    <div class="w-10">
        <input type="radio" name="zuv[]" class="input border mr-2 mt-1" value="<?=$id;?>">
    </div>
    <div class="input-form ml-4 w-7/12">
        <input type="input" name="hariult[<?=$id;?>]" tabindex="<?=$id;?>" class="input w-full border" placeholder="Хариулт" required data-pristine-required-message="Хариулт хоосон байж болохгүй">
    </div>
    <div class="flex justify-center items-center w-20">
        <a class="flex items-center text-theme-6 hariult-delete" href="#"> Устгах</a>
    </div>
</div>