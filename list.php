<?php
/* Variable Map */
/* @var $this Admin_Controller */
/* @var $enquiry Lead */


?>

<style>

.btn-group .btn:first-of-type{
    -webkit-border-top-left-radius: 4px;
    -moz-border-radius-topleft: 4px;
    border-top-left-radius: 4px;
    -webkit-border-bottom-left-radius: 4px;
    -moz-border-radius-bottomleft: 4px;
    border-bottom-left-radius: 4px;
}
</style>

<div class="row">

    <div class="span16">

        <div class="top clearfix">
            <h2 class="pull-left">Enquiries</h2>
            <div class="pull-right"><a class="btn btn-secondary" href="/admin/enquiries/export"><i class="icon-download-alt"></i> Export</a></div>
        </div>

        <hr style="clear: both;" />

        <? if(isset($filter)): ?>
            <input type="hidden" id="default_search" value="<?=$filter;?>" />
        <? endif;?>

        <? if($enquiries->count()) : ?>
        <table class="table table-striped table-bordered datatable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Event ID</th>
                <th>Level</th>
                <th>Size</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Lead Source</th>
                <th>Campaign</th>
                <th>Created</th>
                <th class="actions min-width">Actions</th>
            </tr>
            </thead>

            <tbody>

                <?foreach($enquiries as $enquiry) : ?>
            <tr<?=$enquiry->dead ? ' class="not-booked"' : ''; ?>>
                <td><?=$enquiry->name;?></td>
                <td><a href="/admin/events/edit/<?=$enquiry->event->id;?>"><?=$enquiry->event->event_id;?></a></td>
                <td style="position: relative;min-width: 90px">
                        <? 

                        $levels = [
                            0 => 'STD',
                            1 => 'STD AI A',
                            2 => 'STD AI B',
                            3 => 'VIP',
                            4 => 'VIP AI A',
                            5 => 'VIP AI B',
                            6 => 'Super VIP',
                            7 => 'Super VIP AI A',
                            8 => 'Super VIP AI B',
                            9 => 'Pref S',
                            10 => 'Pref S AI A',
                            11 => 'Pref S AI B',
                        ];

                        ?>
                        <span class="vip"><?=isset($levels[$enquiry->level])?$levels[$enquiry->level]:''; ?></span>
                </td>
                <td><?=$enquiry->size;?></td>
                <td><a href="mailto:<?=$enquiry->email;?>"><?=$enquiry->email;?></a></td>
                <td><a href="tel:<?=preg_replace('/[^0-9\+]/', '', $enquiry->phone);?>"><?=$enquiry->phone;?></a></td>
                <td><?=isset($hear_about_options[$enquiry->hear_about]) ? $hear_about_options[$enquiry->hear_about] : $enquiry->hear_about;?></td>
                <td>
                    <?php

                           $sql = "SELECT * FROM utm_param WHERE enquiry_id = ?";
                            $result = $this->db->query($sql, array($enquiry->id));
                            if ($result->num_rows() > 0) {
                                $row = $result->row_array();
                                if (!empty($row)) {
                                    echo $row['utm_campaign'];
                                }
                            }
                    ?>
                </td>
                <td><span style="display: none;"><?=$enquiry->created;?></span><?=date('l j F, Y g:ia', $enquiry->created);?></td>
                <td>
                    <div class="actions min-width btn-group pull-right">
                        <a class="btn" href="<?=site_url('admin/enquiries/edit/' . $enquiry->id);?>"><i class="icon-eye-open"></i> View</a>
                        <a class="btn btn-danger confirm" href="<?=site_url('admin/enquiries/delete/'.$enquiry->id);?>"><i class="icon-trash"></i> Delete</a>
                    </div>
                </td>
            </tr>
                <? endforeach; ?>

            </tbody>
        </table>

        <?=$this->pagination->create_links();?>

        <? else :?>

        <div class="alert alert-info">
            <i class="icon-info-sign"></i> There doesn't appear to be any enquiries yet.
        </div>

        <? endif; ?>

    </div>

</div>