<?xml version="1.0" encoding="UTF-8"?>
<characterInfo>
    <character classId="{$char['classId']}" genderId="{$char['genderId']}" guildName="{$char['guild']}" level="{$char['level']}" name="{$char['name']}" prefix="{$char['prefix']}" raceId="{$char['raceId']}" suffix="{$char['suffix']}" />
    <characterTab>
        <talentSpecs>
{foreach from=$talents key=key item=talent}
            <talentSpec icon="{$talent['icon']}" prim="{$talent['prim']}" treeOne="{$talent['1']}" treeTwo="{$talent['2']}" treeThree="{$talent['3']}" value="{$talent['value']}" active="{if $key == "active"}1{else}0{/if}"/>
{/foreach}
        </talentSpecs>
        <professions>
{foreach from=$professions key=i item=profession}
            <professions  id="{$i}" value="{$profession['val']}" key="{$profession['key']}" max="{$profession['max']}"/>
{/foreach}
        </professions>
        <stats>
{foreach from=$stats key=i item=stat}
        <stat id="{$i}" value="{$stat}"/>
{/foreach}
        </stats>
        <items>
{foreach from=$items key=i item=item}
            <item icon="{$item['icon']}" id="{$item['id']}" level="{$item['level']}" name="{$item['name']}" permanentenchant="{$item['permanentEnchantItemId']}" rarity="{$item['rarity']}" slot="{$item['slotId']}"  permanentEnchantIcon="spell_fire_masterofelements" permanentEnchantItemId="44159">
{foreach from=$item['gems'] key=j item=gem}
               <gem id="{$gem['id']}"/> 
{/foreach}
            </item>
{/foreach}
        </items>
    </characterTab>
    <summary/>
</characterInfo>
